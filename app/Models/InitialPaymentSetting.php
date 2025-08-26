<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InitialPaymentSetting extends Model
{
    use HasFactory;

    protected $table = 'initial_payment_settings';

    protected $fillable = [
        'min_percentage',
        'max_percentage',
        'is_active',
        'created_by',
        'updated_by',
    ];

    public $timestamps = false;
    
}
