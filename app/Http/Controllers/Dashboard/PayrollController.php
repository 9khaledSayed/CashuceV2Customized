<?php

namespace App\Http\Controllers\Dashboard;

use App\Employee;
use App\Http\Controllers\Controller;
use App\Payroll;
use App\Rules\UniqueMonth;
use App\Salary;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PayrollController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $this->authorize('view_payrolls');
        $payrolls = Payroll::paginate(8);
        $dates          = Payroll::distinct('date')->pluck('date');
        $no_sal_report  = Payroll::all()->count();
        return view('dashboard.payrolls.index', compact(['payrolls','dates','no_sal_report']));
    }

    public function pending(Request $request)
    {
        $this->authorize('view_payrolls');
        $pending_reports = Payroll::where('status', 0)->get();
        if($request->ajax()){
            return response()->json($pending_reports);
        }
        return view('dashboard.payrolls.pending');
    }


    public function create()
    {
        $this->authorize('create_payrolls');
        return view('dashboard.payrolls.create');
    }


    public function store(Request $request)
    {
        $this->authorize('create_payrolls');
        $request->validate(['year_month' => new UniqueMonth()]);
        $payrollDate = Carbon::createFromDate($request->year_month . '-' . 25);
        $employees = Employee::get();

        $total_deductions = $employees->map(function($employee){
           return $employee->deductions();
        })->sum();
        $payroll = Payroll::create([
            'year_month'               => $request->year_month,
            'date'               => $payrollDate,
            'issue_date'         => Carbon::now()->toDateTimeString(),
            'employees_no'       => $employees->count(),
            'total_deductions'   => $total_deductions,
        ]);
        $payroll->update([
            'total_net_salary' => $payroll->salaries->pluck('net_salary')->sum(),
        ]);

        return redirect(route('dashboard.payrolls.show', $payroll));
    }


    public function show(Payroll $payroll, Request $request)
    {
        $this->authorize('show_payrolls');
        if($request->ajax()){
            $salaries = Salary::with(['employee', 'payroll', 'employee.roles'])
                ->where('payroll_id', $payroll->id)->get();
            return response()->json($salaries);
        }
        return view('dashboard.payrolls.show', compact('payroll'));
    }


    public function reissue(Payroll $payroll)
    {
        $this->authorize('proceed_payrolls');
        $payroll->salaries()->delete();
        $employees = Employee::get();
        $monthHolidays = 4;

        $totalDeductions = $employees->map(function($employee){
            return $employee->deductions();
        })->sum();
        $payroll->update([
            'issue_date'         => Carbon::now()->toDateTimeString(),
            'employees_no'       => $employees->count(),
            'total_deductions'   => $totalDeductions,
        ]);
        foreach ($employees as $employee) {
            $workDays = $employee->workDays($payroll->date->month);
            $salaryBeforeDeductions = $workDays * ($employee->salary()/(30 - $monthHolidays));
            $deductions = $employee->deductions();
            $netSalary = $salaryBeforeDeductions  - $deductions;

            Salary::create([
                'employee_id' => $employee->id,
                'payroll_id' => $payroll->id,
                'salary' => $salaryBeforeDeductions,
                'deductions' => $deductions,
                'net_salary' => $netSalary,
                'work_days' => $workDays,
            ]);

        }
        $payroll->update([
            'total_net_salary' => $payroll->salaries->pluck('net_salary')->sum(),
        ]);

        return redirect()->back()->with('reissue', 1);
    }

    public function reject(Payroll $payroll)
    {
        $this->authorize('proceed_payrolls');
        $payroll->update(['status' => 2]);
        return redirect()->back()->with('status', 'reject');
    }

    public function approve(Payroll $payroll)
    {
        $this->authorize('proceed_payrolls');
        $payroll->update(['status' => 1]);
        return redirect()->back()->with('status', 'approve');
    }


    public function destroy(Payroll $payroll)
    {
        //
    }
}
