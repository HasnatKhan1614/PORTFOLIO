<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    // Method to fetch order details for a specific order
    public function orderDetails()
    {
        // Assuming 'order_details' is the related table
        $orderId = $this->id;
        $orderDetails = DB::select("SELECT * FROM order_details WHERE order_id = ?", [$orderId]);

        return $orderDetails;
    }
}
