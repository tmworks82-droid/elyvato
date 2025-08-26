<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Call extends Model
{
    use HasFactory;

    const CREATED_AT = 'created_on';
    const UPDATED_AT = 'updated_at';

    protected $fillable = [
        'booking_id',
        'scheduled_at',
        'call_link',
        'status',
        'notes',
        'is_active',
        'created_on',
        'created_by',
        'updated_by',
        'updated_at',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }


}
