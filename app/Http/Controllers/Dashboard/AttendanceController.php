<?php

namespace App\Http\Controllers\Dashboard;

use App\Attendance;
use App\Company;
use App\Department;
use App\Employee;
use App\Http\Controllers\Controller;
use App\Nationality;
use App\Notifications\AlarmForEmployee;
use App\Notifications\EmployeesLate;
use App\Notifications\LateWarning;
use App\Scopes\SupervisorScope;
use Box\Spout\Writer\Style\StyleBuilder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Rap2hpoutre\FastExcel\FastExcel;

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
            $attendance = Attendance::orderBy('created_at', 'desc')
                ->get()->map(function ($attendance){
                    $employee = $attendance->employee;
                    $isIncludedInSupervised = (isset($employee));
                    if($isIncludedInSupervised){
                        $ShiftType = $attendance->employee->workShift->type;

                        if(isset($attendance->time_out2) && $ShiftType == 'divided'){
                            $timeOut = $attendance->time_out2->format('h:i') ?? null;
                        }elseif(isset($attendance->time_out)){
                            $timeOut = $attendance->time_out->format('h:i') ?? null;
                        }else{
                            $timeOut = null;
                        }
                        $supervisor = $employee->supervisor? $employee->supervisor->name(): '';
                        $department = $employee->department? $employee->department->name(): '';
                        return [
                            'employee' => $attendance->employee,
                            'supervisor' => $supervisor,
                            'nationality' => $employee->nationality(),
                            'department' => $department,
                            'job_number' => $attendance->employee->job_number,
                            'time_in' => $attendance->time_in->format('h:i'),
                            'time_out' => $timeOut,
                            'total_working_hours' => $attendance->total_working_hours,
                            'date' => $attendance->date,
                        ];
                    }

                })->filter();
            return response()->json($attendance);
        }else{
            return view('dashboard.attendances.index', [
                'supervisors' =>  Company::supervisors(),
                'nationalities' => Nationality::get(),
                'departments' => Department::get(),
            ]);
        }

    }

    public function create()
    {
        $this->authorize('view_attendance_record_page');
        return view('dashboard.attendances.create');
    }

    public function createManually()
    {
        $this->authorize('view_attendance_record_page');
        $employees = Employee::get();
        return view('dashboard.attendances.create_manually', compact('employees'));
    }

    public function store(Request $request)
    {

        $this->authorize('view_attendance_record_page');
        $request->validate([
           'barcode' => 'required|numeric|min:8|exists:employees,barcode',
        ]);
        $employee = Employee::where('barcode', $request->barcode)->first();
        $dateTime = Carbon::now();
        $dateTime->minute = $this->roundToQuarterHour($dateTime);
        $response =  $this->storeAttendance($dateTime, $employee);

        return response()->json($response);
    }

    public function storeManually(Request $request)
    {
        $this->authorize('view_attendance_record_page');
        $request->validate([
           'employee_id' => 'required|numeric|exists:employees,id',
           'date_time' => 'required',
        ]);
        $employee = Employee::find($request->employee_id);

        $dateTime = Carbon::createFromFormat('d/m/Y - g:i:s A', $request->date_time);

        $response = $this->storeAttendance($dateTime, $employee);

        return response()->json($response);
    }

    public function getOperation(Employee $employee)
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

    public function storeAttendance(Carbon $dateTime, $employee)
    {
        $workShift = $employee->workShift ?? null;
        $response  = [];
        if (!isset($employee)){
            $response = [
                "status" => true,
                "message" => __("This employee is not under your supervision"),
            ];
        }elseif(!isset($workShift)){
            $response = [
                "status" => true,
                "message" => __("There is No Work shift for employee ") . $employee->name(),
            ];
        }else{
            switch($workShift->type){
                case "divided":
                    $todayAttendance = $employee->attendances()->whereDate('created_at', Carbon::today())->first();
                    if(!isset($todayAttendance)){ //check in

                        Attendance::create([
                            'employee_id' => $employee->id,
                            'time_in' => $dateTime->format('H:i'),
                            'date' => $dateTime->format('Y-m-d'),
                        ]);
                        $response = [
                            "status" => true,
                            "message" => __("The operation check in  has been done successfully for employee ") . $employee->name(),
                        ];

                    }elseif (!isset($todayAttendance->time_out)){

                        $todayAttendance->update([
                            'time_out' => $dateTime->format('H:i'),
                        ]);
                        $response = [
                            'status' => true,
                            "message" => __("The operation check out  has been done successfully for employee ") . $employee->name(),
                        ];

                    }elseif (!isset($todayAttendance->time_in2)){

                        $todayAttendance->update([
                            'time_in2' => $dateTime->format('H:i'),
                        ]);
                        $response = [
                            'status' => true,
                            "message" => __("The operation check in  has been done successfully for employee ") . $employee->name(),
                        ];

                    }elseif (!isset($todayAttendance->time_out2)){

//                    $workingHoursForShift1 = (new Carbon($todayAttendance->time_in))->diff(new Carbon($todayAttendance->time_out));
//                    $workingHoursForShift2 = (new Carbon($todayAttendance->time_in2))->diff($dateTime->format('H:i:s'));
//                    $totalWorkingHours = $workingHoursForShift2->addHours($workingHoursForShift1->format('H'));
//                    $totalWorkingHours->addMinutes($workingHoursForShift1->format('i'));

                        $totalWorkingHours = (new Carbon($todayAttendance->time_in))->diff(new Carbon($dateTime->format('H:i:s')));
                        $todayAttendance->update([
                            'time_out2' => $dateTime->format('H:i'),
                            'total_working_hours' => $totalWorkingHours->format('%h:%I:%s')
                        ]);
                        $response = [
                            'status' => true,
                            "message" => __("The operation check out  has been done successfully for employee ") . $employee->name(),
                        ];

                    }else{

                        $response = [
                            'status' => false,
                            'message' => __('The attendance has been already record for employee ') . $employee->name(),
                        ];

                    }
                    break;
                case "once":
                    $todayAttendance = $employee->attendances()->whereDate('created_at', Carbon::today())->first();
                    if(!isset($todayAttendance)){ //check in

                        Attendance::create([
                            'employee_id' => $employee->id,
                            'time_in' => $dateTime->format('H:i'),
                            'time_out' => $dateTime->addHours($workShift->work_hours),
                            'date' => $dateTime->format('Y-m-d'),
                            'total_working_hours' => Carbon::createFromTime($workShift->work_hours)->format('H:i:s')
                        ]);
                        $response = [
                            "status" => true,
                            "message" => __("The operation check in  has been done successfully for employee ") . $employee->name(),
                        ];

                    }else{
                        $response = [
                            'status' => false,
                            'message' => __('The attendance has been already record for employee ') . $employee->name(),
                        ];
                    }
                    break;
                default: // normal && flexible

                    $todayAttendance = $employee->attendances()->whereDate('created_at', Carbon::today())->first();
                    if(!isset($todayAttendance)){ //check in

                        Attendance::create([
                            'employee_id' => $employee->id,
                            'time_in' => $dateTime->format('H:i'),
                            'date' => $dateTime->format('Y-m-d'),
                        ]);
                        $response = [
                            "status" => true,
                            "message" => __("The operation check in  has been done successfully for employee ") . $employee->name(),
                        ];

                    }elseif (!isset($todayAttendance->time_out)){

                        $totalWorkingHours = (new Carbon($todayAttendance->time_in))->diff(new Carbon($dateTime->format('H:i:s')))->format('%h:%I:%s');

                        $todayAttendance->update([
                            'time_out' => $dateTime->format('H:i'),
                            'total_working_hours' => $totalWorkingHours
                        ]);
                        $response = [
                            'status' => true,
                            "message" => __("The operation check out  has been done successfully for employee ") . $employee->name(),
                        ];

                    }else{

                        $response = [
                            'status' => false,
                            'message' => __('The attendance has been already record for employee ') . $employee->name(),
                        ];

                    }
                    break;
            }
        }

        return $response;
    }

    function roundToQuarterHour($time) {
        $minutes = $time->minute;
        return $minutes - ($minutes % 15);
    }

    public function extractExcel(Request $request)
    {
        $attendances = Attendance::get();
        $fileName = 'attendances.xlsx';
        if(isset($request->full_date)){
            $attendances = Attendance::where('date', $request->full_date)->get();
            $fileName = $request->full_date . '&&attendances.xlsx';
        }

        if(isset($request->month)){
            $dateChunk = explode('-',$request->month);
            $attendances = Attendance::whereMonth('date', $dateChunk[1])->whereYear('date', $dateChunk[0])->get();
            $fileName = $request->month . '&&attendances.xlsx';
        }



        $attendances = $attendances->map(function($attendance){
            $employee = $attendance->employee ;
            $time_in = $attendance->time_in->format('h:iA');
            $work_shift = $employee->workShift;
            $time_out = $work_shift->type == 'divided' ? $attendance->time_out2 : $attendance->time_out;
            $shift_start_time = $work_shift->type == 'once' ? $work_shift->check_in_time :  $work_shift->shift_start_time;
            $shift_work_hours = $work_shift->work_hours;
            $total_working_hours = $attendance->total_working_hours;

            $delayAllowedTime = $work_shift->is_delay_allowed? $work_shift->time_delay_allowed : Carbon::createFromTime(0,0,0);
            $shiftStartTime = $work_shift->type == 'once' ? $work_shift->check_in_time : $work_shift->shift_start_time;
            $shiftStartTime->addMinutes($delayAllowedTime->minute);
            $shiftStartTime->addHours($delayAllowedTime->hour);
            $delay = Carbon::createFromTime(0,0,0)->format('H:i');
            $early = Carbon::createFromTime(0,0,0)->format('H:i');


            if($attendance->time_in->gt($shiftStartTime)){
                $delay = $attendance->time_in->diff($shiftStartTime)->format('%H:%I:%S');
                $delay = date('h:i:s', strtotime($delay));
            }else{
                $early = $attendance->time_in->diff($shiftStartTime)->format('%H:%I:%S');
                $early = date('h:i:s', strtotime($early));

            }

            return [
                __('Job Number') => $employee->job_number,
                __('Employee Name') => $employee->name(),
                __('Shift Start Time') => isset($shift_start_time) ? $shift_start_time->format('h:iA') : '',
                __('TimeIn') => $time_in,
                __('Time Out') => isset($time_out) ? $time_out->format('h:iA') : '',
                __('Shift Work Hours') => $shift_work_hours,
                __('Total Working Hours') => $total_working_hours,
                __('Delay') => $delay,
                __('Early') => $early,
            ];
        });


        $header_style = (new StyleBuilder())
            ->setFontSize(8)
            ->setFontBold()
            ->build();

        $rows_style = (new StyleBuilder())
            ->setFontSize(8)
            ->setBackgroundColor("EDEDED")
            ->build();

        return (new FastExcel($attendances))
            ->headerStyle($header_style)
            ->rowsStyle($rows_style)
            ->download($fileName);
    }

}
