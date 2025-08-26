<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

   
    protected $table = 'invoices';


    // Fillable fields for mass assignment
    protected $fillable = [
        
        'user_id',
        'booking_id',
        'invoice_number',
        'amount',
        'gst_amount',
        'status',
        'invoice_date',
        'due_date',
        'pdf_path',
        'is_active',
        'created_by',
        'updated_by'
        
    ];

 
    public $timestamps = false;

    // Custom datetime fields
    protected $dates = [
        'invoice_date',
        'due_date',
        'created_on',
        'updated_at'
    ];
}
