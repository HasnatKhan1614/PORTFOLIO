<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Renewal extends Model
{
    use HasFactory;

    protected $fillable = ['order_detail_id', 'invoice_number', 'is_renewed', 'renewal_price', 'next_due_date'];

    public function orderDetail()
    {
        return $this->belongsTo(OrderDetail::class);
    }
}
