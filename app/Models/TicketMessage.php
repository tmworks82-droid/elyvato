<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class TicketMessage extends Model
{
    use HasFactory;

     public function ticket()
    {
        return $this->belongsTo(Ticket::class);  
    }

    
}
