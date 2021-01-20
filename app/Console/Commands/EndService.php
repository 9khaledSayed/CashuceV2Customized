<?php

namespace App\Console\Commands;

use App\Employee;
use App\Scopes\ParentScope;
use App\Scopes\ServiceStatusScope;
use App\Scopes\SupervisorScope;
use Carbon\Carbon;
use Illuminate\Console\Command;

class EndService extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'service:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'daily check for contract end date for all employees';

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
        $employees = Employee::withoutGlobalScope(ParentScope::class)
            ->withoutGlobalScope(ServiceStatusScope::class)
            ->withoutGlobalScope(SupervisorScope::class)->get();
        foreach ($employees as $employee){
            if(isset($employee->contract_end_date)){
                if($employee->contract_end_date->lt(Carbon::today())){
                    $employee->service_status = 0;
                    $employee->save();
                }
            }
        }
        return 0;
    }
}
