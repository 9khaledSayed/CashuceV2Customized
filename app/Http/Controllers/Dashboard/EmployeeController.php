<?php

namespace App\Http\Controllers\Dashboard;

use App\Allowance;
use App\Company;
use App\Department;
use App\Employee;
use App\Http\Controllers\Controller;
use App\Nationality;
use App\Role;
use App\Rules\UniqueJopNumber;
use App\Scopes\ServiceStatusScope;
use App\Section;
use App\WorkShift;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public $contract_type = [
        'limited',
        'unlimited',
    ];

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $this->authorize('view_employees');
        if ($request->ajax()){
            $employees = Employee::withoutGlobalScope(new ServiceStatusScope())->get()->map(function($employee){
                $supervisor = $employee->supervisor? $employee->supervisor->name(): '';
                $department = $employee->department? $employee->department->name(): '';
                return [
                    'id' => $employee->id,
                    'role' => $employee->role->name(),
                    'supervisor' => $supervisor,
                    'nationality' => $employee->nationality(),
                    'name' => $employee->name(),
                    'department' => $department,
                    'job_number' => $employee->job_number,
                    'salary' => $employee->salary,
                    'barcode' => $employee->barcode,
                    'service_status' => $employee->service_status,
                    'email_verified_at' => $employee->email_verified_at,
                    'joined_date' => $employee->joined_date,
                ];
            });

            return response()->json($employees);
        }else{

            return view('dashboard.employees.index', [
                'employeesNo' => Employee::get()->count(),
                'supervisors' =>  Company::supervisors(),
                'nationalities' => Nationality::get(),
                'roles' => Role::get(),
                'departments' => Department::get(),
                ]);
        }

    }


    public function create(Request $request)
    {
        $this->authorize('create_employees');
        $allowances = Allowance::all();
        $nationalities = Nationality::all();
        $departments = Department::all();
//        $roles = Role::whereNotIn('label', ['User', 'Super Admin'])->get();
        $roles = Role::get();
        $supervisors = Employee::whereNull('supervisor_id')->get();
        $workShifts = WorkShift::get();


        return view('dashboard.employees.create', [
            'nationalities' => $nationalities,
            'roles' => $roles,
            'contract_type' => $this->contract_type,
            'allowances' =>$allowances,
            'supervisors' =>$supervisors,
            'workShifts' =>$workShifts,
            'departments' => $departments,
        ]);
    }


    public function store(Request $request)
    {
        $this->authorize('create_employees');
        if($request->ajax()){
            $employee = Employee::create($this->validator($request));
            $employee->allowances()->attach($request->allowance);
            return response()->json([
                'status' => true,
            ]);

        }
        return 0;
    }


    public function show(Employee $employee)
    {
        $allowances = Allowance::all();
        $nationalities = Nationality::all();
        $workShifts = WorkShift::get();
        $roles = Role::get();
        $supervisors = Employee::whereNull('supervisor_id')->get();
        return view('dashboard.employees.show', [
            'employee' => $employee,
            'nationalities' => $nationalities,
            'roles' => $roles,
            'contract_type' => $this->contract_type,
            'allowances' =>$allowances,
            'supervisors' =>$supervisors,
            'workShifts' =>$workShifts,
        ]);
    }


    public function edit(Employee $employee)
    {
        $this->authorize('update_employees');
        $allowances = Allowance::all();
        $nationalities = Nationality::all();
        $workShifts = WorkShift::get();
        $roles = Role::get();
        $departments = Department::get();
        $supervisors = Employee::whereNull('supervisor_id')->get();

        return view('dashboard.employees.edit', [
            'employee' => $employee,
            'nationalities' => $nationalities,
            'roles' => $roles,
            'contract_type' => $this->contract_type,
            'allowances' =>$allowances,
            'supervisors' =>$supervisors,
            'workShifts' =>$workShifts,
            'departments' => $departments,
        ]);
    }


    public function update(Request $request, Employee $employee)
    {
        $this->authorize('update_employees');
        if($request->ajax()){
            $employee->update($this->validator($request, $employee->id));
            $employee->allowances()->detach($request->allowance);
            $employee->allowances()->attach($request->allowance);
            return response()->json([
                'status' => true,
            ]);
        }
        return 0;
    }

    public function lateEmployees($notificationId)
    {
        $notification = auth()->user()->notifications->where('id', $notificationId)->first();
        $lateEmployees = Employee::whereIn('id', $notification->data['lateEmployeesIDs'])->get();

        return view('dashboard.employees.late_employees', compact('lateEmployees'));
    }

    public function destroy(Employee $employee)
    {
        //
    }

    public function endService(Employee $employee, Request $request)
    {
        if($request->ajax()){
            $employee->service_status = 0;
            $employee->save();
        }
    }
    public function backToService($id, Request $request)
    {
        $employee = Employee::withoutGlobalScope(new ServiceStatusScope())->find($id);
        if($request->ajax()){
            $employee->service_status = 1;
            $employee->save();
        }
    }


    public function validator(Request $request, $id = null)
    {
        $request->validate([
            'role_id' => 'required|numeric|exists:roles,id',
            ]);
        $rules = Employee::$rules;
        array_push($rules['job_number'], new UniqueJopNumber($id));
        if($id){
            $rules['email'] = ($rules['email'] . ',email,' . $id);
        }
        return $request->validate($rules);
    }

}
