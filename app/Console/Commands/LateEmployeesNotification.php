<?php

namespace App\Console\Commands;

use App\Attendance;
use App\Employee;
use App\Notifications\AlarmForEmployee;
use App\Notifications\EmployeesLate;
use App\Scopes\ParentScope;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;

class LateEmployeesNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lateEmployees:notify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send notifications to hr and supervisor about lat employees.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // after 30 minutes from the start work time
        // get all late employees
        // send notification to all late employees
        // send notifications to supervisor to inform him about the late employees under his supervising
        // send notifications to hr to inform him about the late employees

        $companies = Employee::withoutGlobalScope(ParentScope::class)->whereNull('manager_id')->get();
        foreach ($companies as $company) {
            $employees = $company->employees;
            $HrAndSupervisorCollection = $employees->map(function ($employee){
                $roleLabel = $employee->role->label;
                if($roleLabel == 'HR' || $roleLabel == 'Supervisor')
                    return $employee;
            })->filter(function ($employee){return !is_null($employee);});

            $lateEmployees = $employees->map(function ($employee){
                if($employee->attendances()->whereDate('created_at', Carbon::today())->doesntExist())
                    return $employee;
            })->filter(function ($employee){ return !is_null($employee);});

            if($lateEmployees->count() > 0){
                Notification::send($lateEmployees, new AlarmForEmployee());
                Notification::send($HrAndSupervisorCollection, new EmployeesLate($lateEmployees->pluck('id')->toArray())    );
            }
        }

        return 0;
    }
}
