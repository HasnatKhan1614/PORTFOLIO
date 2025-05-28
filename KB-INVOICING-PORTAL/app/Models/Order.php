<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Order extends Model
{
    protected $fillable = [
        'user_id',
        'bank_information_ids',
        'invoice_number',
        'domain',
        'payment_interval',
        'payment_status',
        'notes',
        'currency',
        'currency_symbol',
        'payment_type',
        'tax_type',
        'tax_value',
    ];

    protected $casts = [
        'bank_information_ids' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            if (!$order->invoice_number) {
                $order->invoice_number = 'INV-' . str_pad(Order::count() + 1, 6, '0', STR_PAD_LEFT);
            }
        });
    }

    /**
     * Get the order details for the order.
     */
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function bank()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function getFormattedCreatedAtAttribute()
    {
        return Carbon::parse($this->created_at)->format('F j, Y');
    }

    public function bankInfos()
    {
        return BankInformation::whereIn('id', $this->bank_information_ids ?? [])->get();
    }



}
