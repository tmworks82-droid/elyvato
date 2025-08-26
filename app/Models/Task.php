<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'milestone_id',
        'assigned_to',
        'due_date',
        'title',
        'description',
        'status',
        'progress',
        'submitted_for_review',
        'reviewed_at',
        'is_active',
        'created_on',
        'created_by',
        'updated_by',
        'is_deleted',
    ];

    public $timestamps = false;

    

    public function milestone()
        {
            return $this->belongsTo(Milestone::class);
        }
        
 public function milestones()
    {
        return $this->belongsTo(Milestone::class, 'milestone_id');
    }



}
