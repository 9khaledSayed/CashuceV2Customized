<?php

namespace App\Console\Commands;

use App\Attendance;
use App\Employee;
use Carbon\Carbon;
use Illuminate\Console\Command;

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
        $lateEmployees = Employee::get()->map(function ($employee){
           if($employee->attendances()->whereDate('created_at', Carbon::today())->doesntExist())
               return $employee;
        });
        return 0;
    }
}
