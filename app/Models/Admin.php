<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;
// use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Models\Department;

class Admin extends Authenticatable
{
    use HasFactory;
    use SoftDeletes, HasApiTokens;


    protected $fillable = [
        'name',
        'email',
        'mobile',
        'username',
        'password',
        'priority',
        'role_id', 
        'department_id',
        'rating',
        'is_hired',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $dates= [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts= [
        'created_at' => "datetime:d-M-Y h:i A",
        'updated_at' => "datetime:d-M-Y h:i A",
        'email_verified_at' => 'datetime',
        'password'=>'hashed',
    ];



    protected function mobile(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                // Return null if the value is null to avoid errors
                if (is_null($value)) {
                    return null;
                }

                // If the number already has the prefix, return it as is
                if (str_starts_with($value, '+91')) {
                    return $value;
                }

                // Otherwise, add the '+91' prefix
                return '+91' . $value;
            }
        );
    }
    

    public function role()
    {
        return $this->belongsTo(Role::class);

    }

    // Update the hasPermission method to check if the user has the required permission
    public function hasPermission($permissionName)
    {
        // dd($this->role->permissions,$permissionName);
        return $this->role->permissions->contains('name', $permissionName);
    }


    public function department()
    {
        return $this->belongsTo(Department::class);
    }


    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }


    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function accountManager()
    {
        return $this->belongsTo(Admin::class, 'account_manager_id');
    }

    public function employee()
    {
        return $this->belongsTo(Admin::class, 'employee_id');
    }

    public function profile()
    {
        return $this->hasOne(UserProfile::class, 'user_id', 'id');
    }



}
