<?php

namespace App\Http\Controllers\Dashboard;

use App\Company;
use App\Department;
use App\Employee;
use App\Nationality;
use App\Http\Controllers\Controller;
use App\Scopes\ServiceStatusScope;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Spatie\Activitylog\Models\Activity;

class DashboardController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth:employee,company');
    }

    public function index()
    {
        $endedEmployees = Employee::withoutGlobalScope(new ServiceStatusScope())->where('service_status', 0)->take(10)->get();
        if(\auth()->guard('company')->check()){
            $activities = Activity::orderBy('created_at', 'desc')->get()->whereIn('causer_id', auth()->user()->employees->pluck('id')) ?? [];
        }else{
            $activities = [];
        }
        $totalEmployees = Company::find(Company::companyID())->employees->count();
        $departments = Department::get()->map(function ($department) use ($totalEmployees){
            $colors = [
                'danger',
                'success',
                'brand',
                'warning',
                'info'
            ];
            $depEmployees = $department->employees;
            if(isset($depEmployees)){
                $percentage = ($department->employees->count() / $totalEmployees) * 100;
            }else{
                $percentage = 0;
            }

            $allDepartmentEmployees = Employee::withoutGlobalScope(new ServiceStatusScope())->where('department_id', $department->id)->get();
            $saudiNo = $allDepartmentEmployees->map(function ($employee){
                if ($employee->nationality() == __('Saudi')){
                    return $employee;
                }
            })->filter()->count();
            $nonSaudiNo = $allDepartmentEmployees->map(function ($employee){
                if ($employee->nationality() != __('Saudi')){
                    return $employee;
                }
            })->filter()->count();
           return[
             'name' => $department->name(),
             'in_service' => $allDepartmentEmployees->where('service_status' , 1)->count(),
             'out_service' => $allDepartmentEmployees->where('service_status' , 0)->count(),
             'saudi_no' => $saudiNo,
             'non_saudi_no' => $nonSaudiNo,
             'percentage' => $percentage,
             'color' => array_rand($colors),
           ];
        });

        return view('dashboard.index', compact('endedEmployees', 'activities', 'departments'));
    }
}
