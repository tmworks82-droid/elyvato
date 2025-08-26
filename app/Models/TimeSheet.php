<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeSheet extends Model
{
    use HasFactory;
    
     protected $fillable = [
        'user_id',      // The user this timesheet belongs to
        'start_time',   // Start time of the timesheet
        'end_time',     // End time of the timesheet
        'status',       // Status (e.g., 'approved', 'pending')
        'created_by',   // The admin who created the timesheet
        'updated_by',   // The admin who updated the timesheet
        'note',         // Additional notes
        'is_active',    // Whether the timesheet is active or not
    ];
    
    
     public function user()
    {
        return $this->belongsTo(Admin::class);
    }

    // A timesheet is created by an admin
    public function createdBy()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    // A timesheet is updated by an admin
    public function updatedBy()
    {
        return $this->belongsTo(Admin::class, 'updated_by');
    }
    
}
