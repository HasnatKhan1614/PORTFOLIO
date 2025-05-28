<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = ['date', 'product_id', 'payment_type', 'transaction_id','discount_amount','discount_percent'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function saleOrderItems()
    {
        return $this->hasMany(SaleOrderItem::class);
    }
    
}
