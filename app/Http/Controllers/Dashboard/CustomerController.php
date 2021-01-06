<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Role;
use App\Employee;
use App\Scopes\ParentScope;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request)
    {
        $this->authorize('view_users');
        if ($request->ajax()){
            $customers = Employee::with('roles')
                ->where('is_manager', true)
                ->whereNull('manager_id')
                ->withoutGlobalScope(ParentScope::class)->get();
            return response()->json($customers);
        }
        return view('dashboard.customers.index');
    }

    public function create()
    {

        $this->authorize('create_users');
        $roles = Role::whereIn('id', [1,2])->get();
        return view('dashboard.customers.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $this->authorize('create_users');
        $customer = Employee::create($this->validator($request));
        $customer->is_manager = true;
        $customer->manager_id = null;
        $customer->save();
        $this->setRole($customer, $request);
        $customer->generateDefaultAllowances();

        return redirect(route('dashboard.customers.index'));
    }

    public function edit($id)
    {
        $this->authorize('update_users');
        $customer = Employee::withoutGlobalScope(ParentScope::class)->find($id);
        $roles = Role::whereIn('id', [1,2])->get();
        return view('dashboard.customers.edit', compact('customer', 'roles'));
    }

    public function update($id, Request $request)
    {
        $this->authorize('update_users');
        $customer = Employee::withoutGlobalScope(ParentScope::class)->find($id);
        $customer->update($this->validator($request, $customer->id));
        $this->setRole($customer, $request);
        return redirect(route('dashboard.customers.index'));
    }

    public function show($id)
    {
        $customer = Employee::withoutGlobalScope(ParentScope::class)->find($id);
        return view('dashboard.customers.show', compact('customer'));
    }

    public function destroy($id, Request $request)
    {
        $this->authorize('delete_users');
        if($request->ajax()){
            $customer = Employee::withoutGlobalScope(ParentScope::class)->find($id)->delete();
            return response()->json([
                'status' => true,
                'message' => 'Item Deleted Successfully'
            ]);
        }
        return redirect(route('dashboard.customers.index'));
    }

    public function validator(Request $request, $id = null)
    {
        $request->validate(['role_id' => 'required|numeric|exists:roles,id']);
        $request['job_number'] = rand(1000,9999);
        while (Employee::pluck('job_number')->contains($request['job_number'])){
            $request['job_number'] = rand(1000,9999);
        }
        $managerRules = Employee::$managerRules;
        if($id){
            $managerRules['email'] = ($managerRules['email'] . ',email,' . $id);
        }
        $jobNumber = rand(1000,9999);
        while (Employee::pluck('job_number')->contains($jobNumber)){
            $jobNumber = rand(1000,9999);
        }

        $request['job_number'] = $jobNumber;
        $request['joined_date'] = '2020-08-01';
        $request['nationality_id'] = '1';
        $request['id_num'] = '54566546544';
        $request['contract_type'] = '1';
        $request['contract_start_date'] = '1';
        $request['contract_period'] = '12';
        $request['phone'] = '0000000000';
        return $request->validate($managerRules);
    }


    public function setRole(Employee $customer, Request $request)
    {
        $role = Role::find($request->role_id);
        $customer->roles()->detach($customer->roles);
        $customer->assignRole($role);
        if($role->label == "User"){
            $customer->generateDefaultRoles();
        }
    }
}
