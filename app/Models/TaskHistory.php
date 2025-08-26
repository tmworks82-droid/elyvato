<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin;

class TaskHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_id',
        'task_status',
        'comment',
        'created_by',
        'updated_by',
        'updated_on',
        'is_delete',
        'is_commit',
    ];

    public function createdBy()
{
    return $this->belongsTo(Admin::class, 'created_by');
}

}
