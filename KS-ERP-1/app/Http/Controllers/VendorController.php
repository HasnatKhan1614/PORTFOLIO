<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;
use App\Models\{
    Vendor,
};

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $vendors = Vendor::all();
        return Inertia::render("Vendor/Index", compact('vendors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render("Vendor/Create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  request()
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $validator = Validator::make(request()->all(), [            
            'name' => 'required',
            // 'email' => 'nullable',
            'address' => 'required',
            // 'country' => 'required',
            'city' => 'required',
            // 'telephone' => 'nullable',
            // 'res' => 'nullable',
            // 'fax' => 'nullable',
            // 's_man' => 'nullable',
            'mobile' => 'nullable',
            // 'strn' => 'nullable',
            // 'ntn' => 'nullable',
            // 'date' => 'nullable',
            // 'balance_type' => 'nullable',
            'opening_balance' => 'nullable',
        ]);
    
        if ($validator->fails()) {
            return $validator->errors();
        }

    
        Vendor::create([
            'name' => request()->name,
            // 'email' => request()->email,
            'address' => request()->address,
            // 'country' => request()->country,
            'city' => request()->city,
            // 'telephone' => request()->telephone,
            // 'res' => request()->res,
            // 'fax' => request()->fax,
            // 's_man' => request()->s_man,
            'mobile' => request()->mobile,
            // 'strn' => request()->strn,
            // 'ntn' => request()->ntn,
            // 'date' => request()->date,
            // 'balance_type' => request()->balance_type,
            'opening_balance' => request()->opening_balance,
        ]);
        return redirect()->route('vendorr.index')->with('success', 'Vendor created successfully.');        
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
    public function edit($edit)
    {
        $vendor = Vendor::find($edit);
        return Inertia::render("Vendor/Edit",compact('vendor'));
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
            'name' => 'required',
            // 'email' => 'nullable',
            'address' => 'required',
            // 'country' => 'required',
            'city' => 'required',
            // 'telephone' => 'nullable',
            // 'res' => 'nullable',
            // 'fax' => 'nullable',
            // 's_man' => 'nullable',
            'mobile' => 'nullable',
            // 'strn' => 'nullable',
            // 'ntn' => 'nullable',
            // 'date' => 'nullable',
            // 'balance_type' => 'nullable',
            'opening_balance' => 'nullable',
        ]);
    
        if ($validator->fails()) {
            return $validator->errors();
        }

        $vendor = Vendor::find($id);
    
    
        $vendor->update([
            'name' => request()->name,
            // 'email' => request()->email,
            'address' => request()->address,
            // 'country' => request()->country,
            'city' => request()->city,
            // 'telephone' => request()->telephone,
            // 'res' => request()->res,
            // 'fax' => request()->fax,
            // 's_man' => request()->s_man,
            'mobile' => request()->mobile,
            // 'strn' => request()->strn,
            // 'ntn' => request()->ntn,
            // 'date' => request()->date,
            // 'balance_type' => request()->balance_type,
            'opening_balance' => request()->opening_balance,
        ]);
    
        return redirect()->route('vendorr.index')->with('success', 'Vendor updated successfully.');        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     $vendor = Vendor::find($id);
     $vendor->delete();
        return back()->with('success', 'Vendor deleted successfully.');
    }
}
