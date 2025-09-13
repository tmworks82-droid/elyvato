<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAvailability extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'day', 'start_time', 'end_time', 'is_closed', 'status'
    ];

    public function admin()
{
    return $this->belongsTo(Admin::class, 'user_id');
}

    
}
