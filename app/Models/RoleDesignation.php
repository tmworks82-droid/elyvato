<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleDesignation extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'is_active',
    ];


    public function userProfiles()
    {
        return $this->hasMany(UserProfile::class, 'role_designation_id');
    }



}
