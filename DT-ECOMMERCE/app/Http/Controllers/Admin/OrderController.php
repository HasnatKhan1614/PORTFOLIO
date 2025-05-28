<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\FuncCall;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::latest()->get();

        return view('admin.order.index',compact('orders'));
    }

    public function order_detail($orderId)
    {
        $orders = DB::table('order_details')->where('order_id',$orderId)->get();

        return view('admin.order.order-detail',compact('orders'));
    }

    public function order_status_update($orderId)
    {
        // Update the status of the order
        $newStatus = request()->input('status');
        DB::table('orders')->where('id', $orderId)->update(['status' => $newStatus]);
    
        // Return a success message
        return response()->json(['message' => 'Order status set to '.$newStatus], 200);
    }
}
