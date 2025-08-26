<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('recurring:subscription-booking')->everyMinute();
        $schedule->command('recurring:subscription-booking')
        ->dailyAt('00:05')              // run nightly; 00:05 avoids exact midnight load
        ->timezone('Asia/Kolkata')      // ensure IST
        ->withoutOverlapping()
        ->runInBackground();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
