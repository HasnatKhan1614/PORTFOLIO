<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class OrderDetail extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'server_id',
        'is_free',
        'price',
        'quantity',
        'time_interval',
        'start_date',
        'end_date',
        'extra_days',
    ];

    /**
     * Get the order that owns the detail.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    

    /**
     * Get the product associated with the order detail.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getFormattedStartDateAttribute()
    {
        return Carbon::parse($this->start_date)->format('M j, Y'); // Short month format
    }

    public function getFormattedEndDateAttribute()
    {
        return Carbon::parse($this->end_date)->format('M j, Y'); // Short month format
    }

}
