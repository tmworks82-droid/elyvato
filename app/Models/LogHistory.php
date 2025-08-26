<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
        'event_type',
        'event_history',
        'json_data',
        'action_performed_by',
        'created_at',
        'created_by',
        'updated_by',
    ];

}
