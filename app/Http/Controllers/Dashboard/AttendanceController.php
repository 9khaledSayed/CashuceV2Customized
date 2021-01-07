<?php

namespace App\Http\Controllers\Dashboard;

use App\Attendance;
use App\Employee;
use App\Http\Controllers\Controller;
use App\Notifications\AlarmForEmployee;
use App\Notifications\EmployeesLate;
use App\Notifications\LateWarning;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class AttendanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $this->authorize('view_attendance_sheet');
        if ($request->ajax()) {
            $attendance = Attendance::with('employee')->get();;
            return response()->json($attendance);
        }
        return view('dashboard.attendances.index');
    }

    public function create()
    {
        $this->authorize('view_attendance_record_page');
        $employees = Employee::whereNotNull('manager_id')->get();
        return view('dashboard.attendances.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $this->authorize('view_attendance_record_page');
        $request->validate([
           'barcode' => 'required|numeric|min:8|exists:employees,barcode',
        ]);
        $employee = Employee::where('barcode', $request->barcode)->first();
        $status = $this->attendanceStatus($employee);
        $dateTime = Carbon::now()->toDate();

        if ($status == 'Check in'){

            Attendance::create([
               'employee_id' => $employee->id,
               'time_in' => $dateTime->format('H:i'),
               'date' => $dateTime->format('Y-m-d'),
            ]);
            $response = [
                'status' => true,
                'operation' => 'Check in',
            ];

        }elseif($status == 'Check out'){

            $attendance = $employee->attendances()->whereDate('created_at', Carbon::today())->first();
            $totalWorkingHours = (new Carbon($attendance->time_in))->diff(new Carbon($dateTime->format('H:i:s')))->format('%h:%I:%s');

            $attendance->update([
                'time_out' => $dateTime->format('H:i'),
                'total_working_hours' => $totalWorkingHours
            ]);
            $response = [
                'status' => true,
                'operation' => 'Check out',
            ];

        }else{
            $response = [
                'status' => false,
                'operation' => 'You have been already record your attendance today',
            ];
        }
        return response()->json($response);
    }

    public function attendanceStatus(Employee $employee)
    {
        $this->authorize('view_attendance_record_page');
        $attendance = $employee->attendances()->whereDate('created_at', Carbon::today())->first();
        $checked_in = isset($attendance->time_in);
        $checked_out = isset($attendance->time_out);


        if(!$checked_in){
            $status = 'Check in';
        } elseif (!$checked_out){
            $status = 'Check out';
        }else{
            $status = 'Attendance and leave have been recorded';
        }

        return $status;
    }

    public function myAttendance()
    {
        $this->authorize('view_my_attendance_history');
        return view('dashboard.attendances.my_attendances', [
            'my_attendances' => auth()->user()->attendances()->get()
        ]);
    }

    public function lateNotification()
    {

        $HrAndSupervisorCollection = Employee::get()->map(function ($employee){
           $roleLabel = $employee->roles->first()->label;
           if($roleLabel == 'HR' || $roleLabel == 'Supervisor')
               return $employee;
        })->filter(function ($employee){return !is_null($employee);});

        $lateEmployees = Employee::get()->map(function ($employee){
            if($employee->attendances()->whereDate('created_at', Carbon::today())->doesntExist())
                return $employee;
        })->filter(function ($employee){ return !is_null($employee);});

        if($lateEmployees->count() > 0){
            Notification::send($lateEmployees, new AlarmForEmployee());
            Notification::send($HrAndSupervisorCollection, new EmployeesLate($lateEmployees->pluck('id')->toArray())    );
        }

        dd('done');
    }

}
