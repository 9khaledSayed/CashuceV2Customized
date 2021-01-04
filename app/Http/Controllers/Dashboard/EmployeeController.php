<?php

namespace App\Http\Controllers\Dashboard;

use App\Allowance;
use App\Employee;
use App\Http\Controllers\Controller;
use App\Nationality;
use App\Role;
use App\Rules\UniqueJopNumber;
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
            $employees = Employee::with('roles')->get();
            return response()->json($employees);
        }
        return view('dashboard.employees.index');
    }


    public function create()
    {
        $this->authorize('create_employees');
        $allowances = Allowance::all();
        $nationalities = Nationality::all();
        $roles = Role::whereNotIn('label', ['User', 'Super Admin'])->get();
        $supervisors = Employee::whereNull('supervisor_id')->whereNotNull('manager_id')->get();

        return view('dashboard.employees.create', [
            'nationalities' => $nationalities,
            'roles' => $roles,
            'contract_type' => $this->contract_type,
            'allowances' =>$allowances,
            'supervisors' =>$supervisors,
        ]);
    }


    public function store(Request $request)
    {
        $this->authorize('create_employees');
        if($request->ajax()){

            $employee = Employee::create($this->validator($request));
            $this->setRole($request, $employee);
            $employee->allowances()->attach($request->allowance);

            return response()->json([
                'status' => true,
            ]);

        }
        return 0;
    }


    public function show(Employee $employee)
    {
        return view('dashboard.employees.show', compact('employee'));
    }


    public function edit(Employee $employee)
    {
        $this->authorize('update_employees');
        $allowances = Allowance::all();
        $nationalities = Nationality::all();
        $roles = Role::whereNotIn('label', ['User', 'Super Admin'])->get();
        $supervisors = Employee::whereNull('supervisor_id')->whereNotNull('manager_id')->get();
        return view('dashboard.employees.edit', [
            'employee' => $employee,
            'nationalities' => $nationalities,
            'roles' => $roles,
            'contract_type' => $this->contract_type,
            'allowances' =>$allowances,
            'supervisors' =>$supervisors,
        ]);
    }


    public function update(Request $request, Employee $employee)
    {
        $this->authorize('update_employees');
        if($request->ajax()){
            $employee->update($this->validator($request, $employee->id));
            $this->setRole($request, $employee);
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

    public function setRole(Request $request, $employee)
    {
        $role = Role::find($request->role_id);
        $employee->roles()->detach($employee->roles);
        $employee->assignRole($role);
    }

    public function validator(Request $request, $id = null)
    {
        $request->validate(['role_id' => 'required|numeric|exists:roles,id']);
        $rules = Employee::$rules;
        array_push($rules['job_number'], new UniqueJopNumber($id));
        if($id){
            $rules['email'] = ($rules['email'] . ',email,' . $id);
        }
        return $request->validate($rules);
    }

}
