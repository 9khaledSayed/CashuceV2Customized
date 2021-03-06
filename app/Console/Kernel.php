<?php

namespace App\Console;

use App\Console\Commands\EndService;
use App\Console\Commands\LateEmployeesNotification;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        LateEmployeesNotification::class,
        EndService::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
//        $schedule->command('lateEmployees:notify')->everyMinute();
        $schedule->command('lateEmployees:notify')->dailyAt('20:00')->timezone('Asia/Riyadh');
        $schedule->command('service:check')->dailyAt('20:00')->timezone('Asia/Riyadh');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
