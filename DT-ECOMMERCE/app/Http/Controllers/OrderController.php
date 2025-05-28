<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Stripe\Stripe;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        return view('orders.create');
    }

    public function store(Request $request)
    {
        try {
            // Validate the request
            $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'company_name' => 'nullable|string|max:255',
                'country' => 'required|string|max:255',
                'street_address' => 'required|string|max:255',
                'apartment' => 'nullable|string|max:255',
                'city' => 'required|string|max:255',
                'state' => 'required|string|max:255',
                'zip_code' => 'required|string|max:10', // Assuming ZIP codes are strings
                'phone' => 'required|string|max:20', // Assuming phone numbers are strings
                'email' => 'required|email|max:255',
                'order_notes' => 'nullable|string',
                'subtotal' => 'required|numeric',
            ]);
    
            // Generate a random 8-digit number
            $randomNumber = mt_rand(10000000, 99999999);
    
            // Concatenate the prefix "LN" with the random number
            $orderID = 'LN' . $randomNumber;
    
            // Start database transaction
            DB::beginTransaction();
    
            // Insert data into the orders table
            $orderId = DB::table('orders')->insertGetId([
                'orderId' => $orderID,
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'company_name' => $request->input('company_name'),
                'country' => $request->input('country'),
                'street_address' => $request->input('street_address'),
                'apartment' => $request->input('apartment'),
                'city' => $request->input('city'),
                'state' => $request->input('state'),
                'zip_code' => $request->input('zip_code'),
                'phone' => $request->input('phone'),
                'email' => $request->input('email'),
                'subtotal' => $request->input('subtotal'),
            ]);
    
            // Insert order details for each product
            foreach ($request->cartItems as $item) {
                DB::table('order_details')->insert([
                    'order_id' => $orderId,
                    'sku' => $item['id'],
                    'name' => $item['name'],
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                ]);
            }
    
            // Commit transaction
            DB::commit();

            Stripe::setApiKey(env('STRIPE_SECRET'));
            // Create a Payment Link
            $paymentLink = \Stripe\Checkout\Session::create([
                'payment_method_types' => ['card', 'affirm'], // Include 'affirm' as a payment method
                'line_items' => [
                    [
                        'price_data' => [
                            'currency' => 'usd',
                            'product_data' => [
                                'name' => 'Your Product Name', // Replace with your product name
                            ],
                            'unit_amount' => $request->subtotal * 100,
                        ],
                        'quantity' => 1,
                    ],
                ],
                'mode' => 'payment',
                'success_url' => route('stripe_success') . "?session_id={CHECKOUT_SESSION_ID}&orderId={$orderID}",
                'cancel_url' => url('/payment/cancel'),
            ]);

            
            $order = Order::where('id',$orderId)->first();

            $order->session_id = $paymentLink->id;
            $order->update();
    
            return response()->json(['success' => 'Payment link generated!', 'paymentLink' => $paymentLink->url]);
        } catch (\Exception $e) {
            // Rollback transaction on exception
            DB::rollBack();
            // Handle exceptions and return error message
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function edit(Order $order)
    {
        return view('orders.edit',compact('order'));
    }

    // public function update(Request $request, Order $order)
    // {
    //     // Validate the request
    //     $request->validate([
    //         'first_name' => 'required|string|max:255',
    //         'last_name' => 'required|string|max:255',
    //         'company_name' => 'nullable|string|max:255',
    //         'country' => 'required|string|max:255',
    //         'street_address' => 'required|string|max:255',
    //         'apartment' => 'nullable|string|max:255',
    //         'city' => 'required|string|max:255',
    //         'state' => 'required|string|max:255',
    //         'zip_code' => 'required|string|max:10', // Assuming ZIP codes are strings
    //         'phone' => 'required|string|max:20', // Assuming phone numbers are strings
    //         'email' => 'required|email|max:255',
    //         'order_notes' => 'nullable|string',
    //     ]);
        

    //     // Update the order
    //     $order->update($request->all());

    //     return redirect()->route('orders.index')
    //                      ->with('success','Order updated successfully');
    // }

    // public function destroy(Order $order)
    // {
    //     $order->delete();

    //     return redirect()->route('orders.index')
    //                      ->with('success','Order deleted successfully');
    // }

    public function payment_success(Request $request)
    {
        
        try {
            // Retrieve the order based on the session ID
            $order = Order::where('session_id', $request->input('session_id'))->firstOrFail();
    
            // Set the Stripe API key
            Stripe::setApiKey(env('STRIPE_SECRET'));
    
            // Update the payment status to 'paid'
            $order->payment_status = 'paid'; 
            $order->save();
        } catch (ModelNotFoundException $e) {
            // Handle the case where the order is not found
            return redirect()->back()->withErrors(['error' => 'Order not found']);
        } catch (\Exception $e) {
            // Handle other exceptions, such as Stripe API errors
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    
        return view('success');
    }
}
