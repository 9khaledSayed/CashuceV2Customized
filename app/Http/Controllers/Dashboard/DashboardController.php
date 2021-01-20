<?php

namespace App\Http\Controllers\Dashboard;

use App\Company;
use App\Department;
use App\Employee;
use App\Http\Controllers\Controller;
use App\Scopes\ServiceStatusScope;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class DashboardController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth:employee,company,provider');
    }

    public function index(Request $request)
    {
        $attendanceSummary = $this->attendanceSummary();
        if($request->ajax()){
            return response()->json($attendanceSummary['employees_attendance']);
        }
        $employeesStatistics = $this->employeesStatistics();
        $departments = $this->departmentsSection();
        $endedEmployees = $this->endedEmployees();
        $activities = $this->employeesActivities();

        return view('dashboard.index', compact('employeesStatistics','endedEmployees', 'activities', 'departments', 'attendanceSummary'));
    }

    public function employeesStatistics()
    {
        $ActiveEmployeesInCompany = Company::find(Company::companyID())->employees;
        $employeesStatistics = [
            "totalActiveEmployees" => $ActiveEmployeesInCompany->count(),
            "total_saudis" => $this->saudisNumber($ActiveEmployeesInCompany),
            "total_non_saudis" => $this->nonSaudisNumber($ActiveEmployeesInCompany),
            "total_married" => $ActiveEmployeesInCompany->where('marital_status', '1')->count(),
            "total_single" => $ActiveEmployeesInCompany->map(function($employee){
                if(!$employee->marital_status){
                    return $employee;
                }
            })->filter()->count(),
            "total_trail" => '??',
        ];
        return $employeesStatistics;
    }

    public function departmentsSection()
    {
        $totalActiveEmployees = Company::find(Company::companyID())->employees->count();

        $departments = Department::get()->map(function ($department) use ($totalActiveEmployees){
            $colors = [
                'danger',
                'success',
                'brand',
                'warning',
                'info'
            ];
            $depEmployees = $department->employees;
            if(isset($depEmployees) && $totalActiveEmployees > 0){
                $percentage = ($department->employees->count() / $totalActiveEmployees) * 100;
            }else{
                $percentage = 0;
            }

            $allDepartmentEmployees = Employee::withoutGlobalScope(new ServiceStatusScope())->where('department_id', $department->id)->get();

            return[
                'name' => $department->name(),
                'in_service' => $allDepartmentEmployees->where('service_status' , 1)->count(),
                'out_service' => $allDepartmentEmployees->where('service_status' , 0)->count(),
                'saudi_no' => $this->saudisNumber($allDepartmentEmployees),
                'non_saudi_no' => $this->nonSaudisNumber($allDepartmentEmployees),
                'percentage' => $percentage,
                'color' => array_rand($colors),
            ];
        });

        return $departments;
    }

    public function endedEmployees()
    {
        return Employee::withoutGlobalScope(new ServiceStatusScope())->where('service_status', 0)->take(10)->get();
    }

    public function employeesActivities()
    {
        $company = Company::find(Company::companyID());
        return Activity::orderBy('created_at', 'desc')->get()->whereIn('causer_id', $company->id) ?? [];
    }

    public function saudisNumber($employees)
    {
        return $employees->map(function ($employee){
            if ($employee->nationality() == __('Saudi')){
                return $employee;
            }
        })->filter()->count();
    }
    public function nonSaudisNumber($employees)
    {
        return $employees->map(function ($employee){
            if ($employee->nationality() != __('Saudi')){
                return $employee;
            }
        })->filter()->count();
    }

    public function attendanceSummary()
    {
        $activeEmployees = Company::find(Company::companyID())->employees;
        $totalActiveEmployees = $activeEmployees->count();
        $absent = $totalActiveEmployees;
        $delay = 0;
        $early = 0;

        $employeesAttendance = [];
        foreach ($activeEmployees as $employee) {
            $todayAttendance = $employee->attendances()->whereDate('created_at', Carbon::today())->first();
            $employeeWorkShift = $employee->workShift;
            if(isset($todayAttendance)){
                $absent--;
                $employeeTimeIn = $todayAttendance->time_in;
                $shiftStartTime = $employeeWorkShift->type == 'once' ? $employeeWorkShift->check_in_time :  $employeeWorkShift->shift_start_time;
                $delayAllowedTime = $employeeWorkShift->is_delay_allowed? $employeeWorkShift->time_delay_allowed : Carbon::createFromTime(0,0,0);
                $shiftStartTime->addMinutes($delayAllowedTime->minute);
                $shiftStartTime->addHours($delayAllowedTime->hour);
                $employeeTimeOut = isset($todayAttendance->time_out) ? $todayAttendance->time_out->format('h:i') : '';

                if($employeeWorkShift->type == 'divided'){
                    $employeeTimeOut = isset($todayAttendance->time_out2) ? $todayAttendance->time_out2->format('h:i') : '';
                }
                if($employeeTimeIn->gt($shiftStartTime)){
                    $delay++;
                }elseif($employeeTimeIn->lt($shiftStartTime)){
                    $early++;
                }



                array_push($employeesAttendance, [
                    'id' => $employee->id,
                    'job_number' => $employee->job_number,
                    'name' => $employee->name(),
                    'status' => $employeeTimeIn->format('h:i') . ' -- ' . $employeeTimeOut,
                ]);
            }
        }

        return [
            'totalActiveEmployees' => $totalActiveEmployees,
            'absent' => $absent,
            'delay' => $delay,
            'early' => $early,
            'employees_attendance' => $employeesAttendance
        ];
    }
}
