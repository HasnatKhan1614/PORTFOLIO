<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorPayable extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendor_id',
        'amount',
        'payment_type',
        'date',
        'remarks',
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id', 'id');
    }
}
