<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;
use App\Models\{
    Inventory,
    Product,
    SaleOrderItem,
    PurchaseOrderItem
};

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inventories = Inventory::with('product')->get();
        return Inertia::render("Inventory/Index", compact('inventories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        return Inertia::render("Inventory/Create", compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $validator = Validator::make(request()->all(), [
            'date' => 'required',
            'product_id' => 'nullable',
            'quantity' => 'required',
        ]);
    
        if ($validator->fails()) {
            return $validator->errors();
        }
    
        Inventory::create([
            'date' => request()->date,
            'product_id' => request()->product_id,
            'quantity' => request()->quantity,
        ]);

        return redirect()->route('inventory.index')->with('success', 'Product created successfully.');        
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
        $inventory = Inventory::find($id);
        $products = Product::all();
        return Inertia::render("Inventory/Edit",compact('inventory','products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $validator = Validator::make(request()->all(), [
            'date' => 'required',
            'product_id' => 'nullable',
            'quantity' => 'required',
        ]);
    
        if ($validator->fails()) {
            return $validator->errors();
        }

        $inventory = Inventory::find($id);
    
    
        $inventory->update([
            'date' => request()->date,
            'product_id' => request()->product_id,
            'quantity' => request()->quantity,
        ]);
    
        return redirect()->route('inventory.index')->with('success', 'Inventory updated successfully.');        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     $inventory = Inventory::find($id);
     $inventory->delete();
        return back()->with('success', 'Inventory deleted successfully.');
    }


    
}
