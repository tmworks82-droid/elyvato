<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Milestone extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'due_date',
        'amount',
        'status',
        'created_on',
        'created_by',
        'updated_by',
    ];
    public $timestamps = false;


    public function tasks()
    {
        return $this->hasMany(Task::class)->where('is_active', 1);
    }
    
     public function task()
    {
        return $this->hasMany(Task::class, 'milestone_id');
    }

}
