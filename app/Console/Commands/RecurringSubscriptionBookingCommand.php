<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\RecurringSubscription;

class RecurringSubscriptionBookingCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * You will use this to run the command manually:
     * php artisan recurring:subscription-booking
     */
    protected $signature = 'recurring:subscription-booking';

    /**
     * The console command description.
     */
    protected $description = 'Run recurring subscription booking logic daily at midnight';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        RecurringSubscription::RecurringSubscriptionBooking();

        $this->info('Recurring subscription booking process completed.');
    }
}
