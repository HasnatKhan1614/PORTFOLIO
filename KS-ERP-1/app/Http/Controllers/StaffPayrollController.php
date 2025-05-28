<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;
use App\Models\{
    StaffPayroll,
    Staff
};

class StaffPayrollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $staff_payrolls = StaffPayroll::with('staff')->get();

        return Inertia::render("StaffPayroll/Index", compact('staff_payrolls'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $years = [];
        for ($year = date('Y'); $year >= date('Y') - 33; $year--){
            $years[] = $year;
        }
        $staff = Staff::all();
        return Inertia::render("StaffPayroll/Create",compact('staff','years'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  request()
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'month' => 'required',
            'year' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $staff_payroll = StaffPayroll::where('staff_id',request()->staff_id)->where('month',request()->month)->where('year',request()->year)->get();
        if (!$staff_payroll->isEmpty()) {
            return response()->json(['errors' => 'Payroll already exists'], 400);
        }
    
        if (request()->has('staff_id')) {
            StaffPayroll::create([
                'staff_id' => request()->staff_id,
                'month' => request()->month,
                'year' => request()->year,
            ]);
    
            // Return a JSON success response
            return response()->json(['success' => 'Created successfully'], 200);

        }
    
        // Get the selected staff IDs from the request
        $staffIds = request()->staff_ids;
    
        // Loop through the selected staff IDs and create payroll records
        foreach ($staffIds as $staffId) {
            StaffPayroll::create([
                'staff_id' => $staffId,
                'month' => request()->month,
                'year' => request()->year,
            ]);
        }
    
        // Return a JSON success response
        return response()->json(['message' => 'Created successfully'], 200);
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
        $years = [];
    
        for ($year = date('Y'); $year >= date('Y') - 33; $year--){
            $years[] = $year;
        }
        $staff = Staff::all();
        $staff_payroll = StaffPayroll::find($id);
        return Inertia::render("StaffPayroll/Edit",compact('staff_payroll','staff','years'));
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
        
        $validator = Validator::make($request->all(), [
            'month' => 'required',
            'year' => 'required',
            'staff_id' => 'required|array',
        ]);
    
        if ($validator->fails()) {
            return $validator->errors();
        }

        $staff_payroll = StaffPayroll::find($id);

        $staff_payroll->update([
            'staff_id' => request()->staff_id,
            'month' => request()->month,
            'year' => request()->year,
        ]);
    
        return redirect()->route('staff-payroll.index')->with('success', 'updated successfully');     
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     $staff_payroll = StaffPayroll::find($id);
     $staff_payroll->delete();
        return back()->with('success', 'deleted successfully.');
    }


}
