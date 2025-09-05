<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Admin;
use App\Models\RoleDesignation;


class UserProfile extends Model
{
    use HasFactory;

    protected $table = 'user_profiles';

    protected $primaryKey = 'id';

    public $timestamps = false; // Custom timestamps used (created_on, updated_at)

    protected $fillable = [
        'user_id',
        'company_name',
        'gst_number',
        'work_strength',
        'role_designation_id',
        'address_line1',
        'address_line2',
        'city',
        'state',
        'bio',
        'image',
        'country',
        'pincode',
        'industry_type',
        'is_active',
        'created_on',
        'created_by',
        'updated_at',
        'updated_by',
        'understanding',
        'tech_knowledge',
        'final_score',
        'talent_definition',
        'years_experience',
        'highest_qualification',
        'languages_spoken',
        'certification_file',
        'portfolio_file',
        'rate_card_file',
        'account_holder_name',
        'bank_name',
        'ifsc_code',
        'account_number',
    ];

    
    protected $casts = [
        'created_on' => 'datetime',
        'updated_at' => 'datetime',
        'is_active' => 'string',
    ];

    // Relationships

    public function user(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'user_id');
    }


    public function admin()
    {
        return $this->belongsTo(Admin::class, 'user_id', 'id');
    }


    public function creator(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }


    public function updater(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'updated_by');
    }


    public function designation()
    {
        return $this->belongsTo(RoleDesignation::class, 'role_designation_id');
    }


}
