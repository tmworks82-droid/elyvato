<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Ticket extends Model
{
    use HasFactory;

    public function messages()
    {
        return $this->hasMany(TicketMessage::class);
    }

    public function user()
    {
        return $this->belongsTo(Admin::class);
    }
    
     /**
     * Auto-close tickets older than 24 hours
     */

    public static function CloseTicket()
    {
        $cutoff = Carbon::now()->subHours(24);

       
        $tickets = self::where(function ($q) {
                $q->whereNull('ticket_close')
                  ->orWhere('ticket_close', '!=', 'close');
            })
            ->where('created_at', '<=', $cutoff)
            ->get();

        foreach ($tickets as $ticket) {
            $ticket->ticket_close = 'close';   
            $ticket->status       = 'closed';  
            $ticket->closed_by    = 0;         
            $ticket->closed_at    = Carbon::now();
            $ticket->save();

            // optional logging
            Log::info("Auto-closed ticket #{$ticket->id} by cron (older than 24 hrs).");
        }

        return $tickets->count();
    }
    

}
