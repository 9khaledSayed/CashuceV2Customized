<?php

namespace App\Http\Controllers\Dashboard;

use App\Employee;
use App\Http\Controllers\Controller;
use App\Role;
use App\Rules\UniqueJopNumber;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
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
        $roles = Role::whereNotIn('label', ['User', 'Super Admin'])->get();
        $supervisors = Employee::whereNull('supervisor_id')->whereNotNull('manager_id')->get();
        return view('dashboard.employees.create', compact('roles', 'supervisors'));
    }

    public function store(Request $request)
    {
        $this->authorize('create_employees');
        $employee = Employee::create($this->validator($request));
        $this->setRole($request, $employee);
        return redirect(route('dashboard.employees.index'));
    }

    public function edit(Employee $employee)
    {
        $this->authorize('update_employees');
        $roles = Role::whereNotIn('label', ['User', 'Super Admin'])->get();
        $supervisors = Employee::whereNull('supervisor_id')->whereNotNull('manager_id')->get();
        return view('dashboard.employees.edit', compact('employee', 'roles', 'supervisors'));
    }

    public function update(Employee $employee, Request $request)
    {
        $this->authorize('update_employees');
        $employee->update($this->validator($request, $employee->id));
        $this->setRole($request, $employee);
        return redirect(route('dashboard.employees.index'));
    }

    public function show(Employee $employee)
    {
        return view('dashboard.employees.show', compact('employee'));
    }

    public function destroy(Employee $employee, Request $request)
    {
        $this->authorize('delete_employees');
        if($request->ajax()){
            $employee->delete();
            return response()->json([
                'status' => true,
                'message' => 'Item Deleted Successfully'
            ]);
        }
        return redirect(route('dashboard.employees.index'));
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

    public function lateEmployees($notificationId)
    {
        $notification = auth()->user()->notifications->where('id', $notificationId)->first();
        $notification->markAsRead();
        $lateEmployees = Employee::whereIn('id', $notification->data['lateEmployeesIDs'])->get();
        return view('dashboard.employees.late_employees', compact('lateEmployees'));
    }
}
