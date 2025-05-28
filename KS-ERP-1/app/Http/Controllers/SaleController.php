<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Exception;
use App\Models\{
    Sale,
    Product,
    SaleOrderItem
};

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::with('product')->get();
        return inertia::render('Sale/Index', compact('sales'));

    }

    public function create()
    {
        $products = Product::all();
        return inertia::render('Sale/Create',compact('products'));
    }


public function store()
{
    $validator = Validator::make(request()->all(), [
        'date' => 'required',
        'payment_type' => 'required',
        'product_id' => 'required',
        'price' => 'required',
        'discount_amount' => 'nullable',
        'discount_percent' => 'nullable',
        'quantity' => 'required',
    ]);

    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    }

    try {
        // Start a database transaction
        DB::beginTransaction();

        $date = request()->date;
        $product_ids = request()->product_id;
        $prices = request()->price;
        $quantities = request()->quantity;
        $payment_type = request()->payment_type;
        $discount_amount = request()->discount_amount;
        $discount_percent = request()->discount_percent;

        // Generate a unique transaction ID
        $transaction_id = Str::uuid();

        // Assuming the product_ids and quantities arrays have the same length
        $count = count($product_ids);

        $sale = Sale::create([
            'date' => $date,
            'discount_amount' => $discount_amount,
            'discount_percent' => $discount_percent,
            'payment_type' => $payment_type,
            'transaction_id' => $payment_type == 'cash' ? '' : $transaction_id,
        ]);

        for ($i = 0; $i < $count; $i++) {
            $product = Product::where('id', $product_ids[$i])->first();
            
            // dd($product->quantity < $quantities[$i]);
            if ($product->quantity < $quantities[$i]) {
                // Rollback the transaction and return an error message
                DB::rollBack();
                return response()->json(['error' => 'Insufficient product quantity: ' . $product->name], 422);

            }
            // dd($product);
            
            SaleOrderItem::create([
                'sale_id' => $sale->id,
                'product_id' => $product_ids[$i],
                'price' => $prices[$i],
                'quantity' => $quantities[$i],
            ]);
            $product->quantity -= $quantities[$i];
            $product->save(); // Save the updated product quantity
        }

        // Commit the transaction if everything is successful
        DB::commit();

        return back()->with('success', 'Sale created successfully.');
    } catch (Exception $e) {
        // Handle any exceptions and return an error message
        DB::rollBack();
        return back()->with('error', 'Error creating the sale.');
    }
}

    public function edit($id)
    {
        $sale = Sale::find($id);
        $products = Product::all();
        $sale_order_item = SaleOrderItem::where('sale_id',$id)->get();
        return inertia::render('Sale/Edit', compact('sale','products','sale_order_item'));
    }

    public function update($id)
    {
        // Validate the request data
        $validator = Validator::make(request()->all(), [
            'date' => 'required',
            'payment_type' => 'required',
            'transaction_id' => 'nullable',
            'product_id' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            // Add other validation rules as needed
        ]);
    
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $date = request()->date;
        $product_ids = request()->product_id;
        $prices = request()->price;
        $quantities = request()->quantity;
        $payment_type = request()->payment_type;
        $transaction_id = request()->transaction_id;

        $sale = Sale::find($id);
    
        // Update the sale record
        $sale->update([
            'date' => $date,
            'payment_type' => $payment_type,
            'transaction_id' => $transaction_id,
            'discount_amount' => $discount_amount,
            'discount_percent' => $discount_percent,
            // Update other fields here
        ]);
    
        // Delete existing sale order items
        $sale->saleOrderItems()->delete();
    
        $count = count($product_ids);
    
        for ($i = 0; $i < $count; $i++) {
            SaleOrderItem::create([
                'sale_id' => $sale->id,
                'product_id' => $product_ids[$i],
                'price' => $prices[$i],
                'quantity' => $quantities[$i],
            ]);
        }
    
        return redirect()->route('sale.index')->with('success', 'Purchase updated successfully.');
    }

    public function destroy($id)
    {
        $sale = Sale::find($id);
        $sale->delete();
        return redirect()->route('sale.index')->with('success', 'Sale deleted successfully.');
    }

    public function searchByBarcode($barcode)
    {
        $product = Product::where('barcode',$barcode)->first();
        return $product;

    }

    public function pos()
    {
        $products = Product::all();
        return inertia::render('Sale/POS',compact('products'));
    }

    public function view($id)
    {
        $sales = Sale::with('saleOrderItems', 'saleOrderItems.product')->where('id', $id)->first();
        
        if (!$sales) {
            return abort(404); // Handle case where the sale doesn't exist
        }
    
        // Define the dynamic data array
        $data = [
            'sale' => [
                'id' => $sales->id,
                'date' => $sales->date,
                'payment_type' => $sales->payment_type,
                'transaction_id' => $sales->transaction_id,
                'discount_percent' => $sales->discount_percent != '' ? $sales->discount_percent : null,
                'discount_amount' => $sales->discount_amount != '' ? $sales->discount_amount : null,
            ],
            'saleOrderItem' => $sales->saleOrderItems->map(function ($item) {
                return [
                    'sale_id' => $item->sale_id,
                    'product_id' => $item->product->name,
                    'price' => $item->price,
                    'quantity' => $item->quantity,
                ];
            }),
        ];

    
        return inertia::render('Sale/View', compact('data'));
    }
}

