<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_model_id',
        'name',
        'description',
        'quantity',
        'buying_price',
        'selling_price',
        'year',
        'barcode',
    ];

    public function sale()
    {
        return $this->hasMany(Sale::class);
    }

    public function purchase()
    {
        return $this->hasMany(PurchaseOrderItem::class);
    }

    public function car_model()
    {
        return $this->belongsTo(CarModel::class, 'car_model_id', 'id');
    }

    
}
