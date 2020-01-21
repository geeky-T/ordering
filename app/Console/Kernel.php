<?php

namespace App\Console;

use CronFunctions\Renting;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Psy\Command\Command;
use function foo\func;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\chargeRent::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
        $schedule->command('hour:chargeRent')
            ->hourly()
            ->before(function () {
                echo "Task About to Start\n";
            })
            ->after(function (){
                echo "Task Ended\nResult: ";
            })
            ->onSuccess(function (){
                echo "Successful @ ".date('Y-m-d H:i:s')."\n";;
            })
            ->onFailure(function (){
                echo "Failed @ ".date('Y-m-d H:i:s')."\n";
            })
            ->appendOutputTo('logs/scheduler.log');
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
