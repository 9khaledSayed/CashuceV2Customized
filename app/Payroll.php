<?php

namespace App;

use App\Scopes\ParentScope;
use App\Scopes\SupervisorScope;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Payroll extends Model
{
    use LogsActivity;

    protected $guarded=[];
    protected $dates = ['date', 'issue_date'];
    protected $casts = [
        'date'  => 'date:M-Y',
    ];

    protected static $logUnguarded = true;

    public function getDescriptionForEvent(string $eventName): string
    {
        $baseName = class_basename(__CLASS__);
        return "$baseName has been {$eventName}";
    }

    protected static function booted()
    {
        parent::booted(); // TODO: Change the autogenerated stub
        static::addGlobalScope(new ParentScope());
        static::addGlobalScope(new SupervisorScope());

        static::creating(static function ($model){
            $model->company_id = Company::companyID();
            if(auth()->user()->role->label == 'Supervisor'){
                $model->supervisor_id = auth()->user()->id;
            }

        });

        static::created(function ($payroll){
            $employees = Employee::get();

            foreach ($employees as $employee) {
                $payrollDay = setting('payroll_day') ?? 30;
                $workDays = $employee->workDays($payroll->date->month);
                $workDays = $workDays > $payrollDay ? $payrollDay : $workDays;  // 26 - 25
                $daysOff = $employee->daysOff();
                $totalPackage = $workDays * ($employee->totalPackage()/(30 - $daysOff));
                $deductions = $employee->deductions() + $employee->gosiDeduction();
                $netPay = $totalPackage  - $deductions;

                Salary::create([
                    'employee_id' => $employee->id,
                    'payroll_id' => $payroll->id,
                    'salary' => $totalPackage,
                    'deductions' => $deductions,
                    'net_salary' => $netPay,
                    'work_days' => $workDays,
                ]);

            }
        });
    }

    public function creator()
    {
        $supervisor = $this->supervisor;
        if (isset($supervisor)){
            return '( ' . $supervisor->name() . ' )';
        }else{
            return __('( Company Payroll )');
        }
    }

    public function supervisor()
    {
        return $this->belongsTo(Employee::class, 'supervisor_id')->withoutGlobalScope(new SupervisorScope());
    }

    public function salaries()
    {
        return $this->hasMany(Salary::class);
    }
}
