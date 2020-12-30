<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Salary;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function mySalaries(Request $request)
    {
        $this->authorize('view_my_salaries');
        if($request->ajax()){
            $my_salaries = Salary::with('payroll')
                ->where('employee_id', auth()->user()->getAuthIdentifier())->get();
            return response()->json($my_salaries);
        }
        return view('dashboard.salaries.my_salaries');
    }

    public function show(Salary $salary, Request $request)
    {
        return  view('dashboard.salaries.show', compact('salary'));
    }

}
