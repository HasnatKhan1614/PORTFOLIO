<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;
use App\Models\{
    VendorPayable,
    Vendor,
    Purchase,
};

class VendorPayableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendor_payables = VendorPayable::with('vendor')->get();
        return Inertia::render("VendorPayable/Index", compact('vendor_payables'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vendors = Vendor::all();
        return Inertia::render("VendorPayable/Create",compact('vendors'));
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
            'vendor_id' => 'required',
            'amount' => 'required',
            'payment_type' => 'nullable',
            'date' => 'required',
            'remarks' => 'required',
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        


        VendorPayable::create([
            'vendor_id' => request()->vendor_id,
            'amount' => request()->amount,
            'payment_type' => request()->payment_type,
            'date' => request()->date,
            'remarks' => request()->remarks,
        ]);


        return redirect()->route('vendor-payable.index')->with('success', 'Vendor Payable created successfully.');
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
        $vendor_payable = VendorPayable::find($id);
        $vendors = Vendor::all();
        return Inertia::render("VendorPayable/Edit", compact('vendor_payable','vendors'));
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
            'vendor_id' => 'required',
            'amount' => 'required',
            'payment_type' => 'nullable',
            'date' => 'required',
            'remarks' => 'required',
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }


        $vendor_payable = VendorPayable::find($id);


        $vendor_payable->update([
            'vendor_id' => request()->vendor_id,
            'amount' => request()->amount,
            'payment_type' => request()->payment_type,
            'date' => request()->date,
            'remarks' => request()->remarks,
        ]);


        return redirect()->route('vendor-payable.index')->with('success', 'Vendor Payable updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     $vendor_payable = VendorPayable::find($id);
     $vendor_payable->delete();
        return back()->with('success', 'Vendor Payable deleted successfully.');
    }

    public function vendor_balance($vendor_id)
    {
        $balance = 0; 
        $vendor = Vendor::find($vendor_id);
    
        $balance += $vendor->opening_balance;
    
        $purchases = Purchase::where('vendor_id', $vendor_id)->get(); // Don't forget to execute the query with get()
        $payable_amount = VendorPayable::where('vendor_id', $vendor_id)->sum('amount'); // Don't forget to execute the query with get()
    
        foreach ($purchases as $purchase) {
            foreach ($purchase->purchaseOrderItems as $item) {
                $balance += $item->price * $item->quantity; // Accumulate the balance correctly
            }
        }

        $balance = $balance - $payable_amount;
        
    
        return ['balance' => $balance]; // Return the balance as a JSON response
    }
    

}
