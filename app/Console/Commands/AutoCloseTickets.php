<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Ticket;

class AutoCloseTickets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tickets:autoclose';

    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically close tickets older than 24 hours';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $count = Ticket::CloseTicket();
        $this->info("Closed {$count} tickets older than 24 hours.");
    }
}
