<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomInvoice extends Model
{
    protected $fillable = [
        'invoice_number',
        'c_name',
        'c_email',
        'c_phone',
        'c_address',
        'company_name',
        'notes',
        'bank_information_ids',
        'payment_status',
        'meta_data',
        'logo_image',
        'currency',
        'currency_symbol',
    ];

    protected $casts = [
        'meta_data' => 'array',
        'bank_information_ids' => 'array',

    ];
    

    
}
