<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;
use App\Models\{
    ExpensePayableHead,
    ExpensePayable
};

class ExpensePayableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expense_payables = ExpensePayable::with('expense_payable_head')->get();

        return Inertia::render("ExpensePayable/Index", compact('expense_payables'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $expense_payable_heads = ExpensePayableHead::all();
        return Inertia::render("ExpensePayable/Create",compact('expense_payable_heads'));
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
            'expense_payable_head_id' => 'required',
            'amount' => 'required',
            'remarks' => 'required',
            'date' => 'required',
        ]);
    
        if ($validator->fails()) {
            return $validator->errors();
        }
    
        ExpensePayable::create([
            'expense_payable_head_id' => request()->expense_payable_head_id,
            'amount' => request()->amount,
            'remarks' => request()->remarks,
            'date' => request()->date,
        ]);
    
        return redirect()->route('expense-payable.index')->with('success', 'created successfully.');
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
        $expense_payable = ExpensePayable::find($id);
        $expense_payable_heads = ExpensePayableHead::all();
        return Inertia::render("ExpensePayable/Edit",compact('expense_payable','expense_payable_heads'));
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
            'expense_payable_head_id' => 'required',
            'amount' => 'required',
            'remarks' => 'required',
            'date' => 'required',
        ]);
    
        if ($validator->fails()) {
            return $validator->errors();
        }


        $expense_payable = ExpensePayable::find($id);

    
    
        $expense_payable->update([
            'expense_payable_head_id' => request()->expense_payable_head_id,
            'amount' => request()->amount,
            'remarks' => request()->remarks,
            'date' => request()->date,

        ]);
    
        return redirect()->route('expense-payable.index')->with('success', 'updated successfully.');        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     $expense_payable = ExpensePayable::find($id);
     $expense_payable->delete();
        return back()->with('success', 'deleted successfully.');
    }


}
