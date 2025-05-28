<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;
use App\Models\{
    Staff,
};

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $years = [];
    
        for ($year = date('Y'); $year >= date('Y') - 33; $year--){
            $years[] = $year;
        }
        $staff = Staff::all();

        return Inertia::render("Staff/Index", compact('staff','years'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render("Staff/Create");
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
            'identity_number' => 'required',
            'name' => 'required',
            'contact' => 'required',
            'address' => 'required',
            'salary' => 'required',
        ]);
    
        if ($validator->fails()) {
            return $validator->errors();
        }
    
        $staff = Staff::create([
            'identity_number' => request()->identity_number,
            'name' => request()->name,
            'contact' => request()->contact,
            'address' => request()->address,
            'salary' => request()->salary,
        ]);
    
        return response()->json(['success' => 'created successfully'], 200);
        
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $staff = Staff::find($id);
        return Inertia::render("Staff/Edit",compact('staff'));
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
            'identity_number' => 'required',
            'name' => 'required',
            'contact' => 'required',
            'address' => 'required',
            'salary' => 'required',
        ]);
    
        if ($validator->fails()) {
            return $validator->errors();
        }



        $staff = Staff::find($id);

    
    
        $staff->update([
            'identity_number' => request()->identity_number,
            'name' => request()->name,
            'contact' => request()->contact,
            'address' => request()->address,
            'salary' => request()->salary,

        ]);
    
        return redirect()->route('staff.index')->with('success', 'updated successfully.');        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     $staff = Staff::find($id);
     $staff->delete();
        return back()->with('success', 'deleted successfully.');
    }


}
