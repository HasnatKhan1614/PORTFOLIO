<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'user_id',
        'invoice_number',
        'type',
        'channel',
        'sent_at',
        'is_successful',
        'response_details',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderDetail()
    {
        return $this->belongsTo(OrderDetail::class);
    }
    
}
