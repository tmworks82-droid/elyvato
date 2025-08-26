<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\StatementOfWork;

class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';

    protected $fillable = [
        'booking_id',
        'account_manager_id',
        'employee_id',
        'project_status',
        'started_at',
        'completed_at',
        'is_active',
        'created_by',
        'updated_by',
    ];

    public $timestamps = false; // because you're using custom timestamps

    // Optionally, define relationships here
    public function statementOfWork()
    {
        return $this->belongsTo(StatementOfWork::class, 'sow_id');
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }

    public function accountManager()
    {
        return $this->belongsTo(Admin::class, 'account_manager_id');
    }

    public function employee()
    {
        return $this->belongsTo(Admin::class, 'employee_id');
    }

    public function milestones()
    {
        return $this->hasMany(Milestone::class);
    }




}
