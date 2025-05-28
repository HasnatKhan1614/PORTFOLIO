<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;
use App\Models\ExpensePayableHead;

class ExpensePayableHeadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expense_payable_heads = ExpensePayableHead::all();

        return Inertia::render("ExpensePayableHead/Index", compact('expense_payable_heads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render("ExpensePayableHead/Create");
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
            'name' => 'required',
        ]);
    
        if ($validator->fails()) {
            return $validator->errors();
        }
    
        ExpensePayableHead::create([
            'name' => $request->name,
        ]);
    
        return redirect()->route('expense-payable-head.index')->with('success', 'created successfully.');
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
        $expense_payable_head = ExpensePayableHead::find($id);
        return Inertia::render("ExpensePayableHead/Edit",compact('expense_payable_head'));
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
        ]);
    
        if ($validator->fails()) {
            return $validator->errors();
        }


        $expense_payable_head = ExpensePayableHead::find($id);

    
    
        $expense_payable_head->update([
            'name' => request()->name,

        ]);
    
        return redirect()->route('expense-payable-head.index')->with('success', 'updated successfully.');        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     $expense_payable_head = ExpensePayableHead::find($id);
     $expense_payable_head->delete();
        return back()->with('success', 'deleted successfully.');
    }


}
