<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Exception;
use App\Models\{
    Product,
    Purchase,
    Vendor,
    PurchaseOrderItem,
};

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        $vendors = Vendor::all();
        $purchases = Purchase::with('product')->with('vendor')->get();

        return Inertia::render("Purchase/Index", compact('products','purchases','vendors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        $vendors = Vendor::all();
        return Inertia::render("Purchase/Create",compact('products','vendors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  request()
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required',
            'vendor_id' => 'required',
            'purchaseItems' => 'required|array',
            'purchaseItems.*.product_id' => 'required',
            'purchaseItems.*.price' => 'required',
            'purchaseItems.*.quantity' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => 'Error creating the purchase'], 422);
        }
    
        try {
            DB::beginTransaction();
    
            $date = $request->input('date');
            $vendor_id = $request->input('vendor_id');
    
            $purchase = Purchase::create([
                'date' => $date,
                'vendor_id' => $vendor_id,
            ]);
    
            foreach ($request->input('purchaseItems') as $item) {
                PurchaseOrderItem::create([ 
                    'purchase_id' => $purchase->id,
                    'product_id' => $item['product_id'],
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                ]);
            }
    
            DB::commit();
    
            return response()->json(['success' => 'Purchase created successfully'], 201); // 201 Created
        } catch (QueryException $e) {
            DB::rollBack();
            return response()->json(['error' => 'Error creating the purchase: ' . $e->getMessage()], 500); // 500 Internal Server Error
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $products = Product::all();
        $vendors = Vendor::all();
        $purchase = Purchase::find($id);
        $purchase_order_item = PurchaseOrderItem::where('purchase_id',$id)->get();
        return Inertia::render("Purchase/Edit", compact('products','purchase','vendors','purchase_order_item'));

        // if($purchase){
        //     return $purchase;
        // }else{
        //     return back()->with('error', 'Purchase not found.');        
        // }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  request()
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $validator = Validator::make(request()->all(), [
            'date' => 'required',
            'vendor_id' => 'required',
            // Uncomment these lines if you want to validate product_id, price, and quantity
            // 'product_id' => 'required',
            // 'price' => 'required',
            // 'quantity' => 'required',
        ]);
    
        if ($validator->fails()) {
            return $validator->errors();
        }
    
        $date = request()->date;
        $vendor_id = request()->vendor_id;
    
        // Retrieve the existing purchase by its ID
        $purchase = Purchase::find($id);
    
        if (!$purchase) {
            return abort(404); // Handle the case where the purchase is not found.
        }
    
        // Update the purchase properties
        $purchase->date = $date;
        $purchase->vendor_id = $vendor_id;
        $purchase->save();
    
        // Delete the previous purchase order items
        $purchase->purchaseOrderItems()->delete();
    
        // Process and add new purchase order items
        $purchaseItems = request()->purchaseItems;
        foreach ($purchaseItems as $itemData) {
            PurchaseOrderItem::create([
                'purchase_id' => $purchase->id,
                'product_id' => $itemData['product_id'],
                'price' => $itemData['price'],
                'quantity' => $itemData['quantity'],
            ]);
        }
    
        return redirect()->route('purchase.index')->with('success', 'Purchase updated successfully.');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $purchase = Purchase::find($id);
        $purchase->delete();
        return back()->with('success', 'Purchase deleted successfully.');

    }
}
