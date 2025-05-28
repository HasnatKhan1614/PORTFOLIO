<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;
use App\Models\Make;

class MakeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $makes = Make::all();

        return Inertia::render("Make/Index", compact('makes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render("Make/Create");
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
    
        $make = Make::create([
            'name' => $request->name,
        ]);
    
        return redirect()->route('make.index')->with('success', 'Make created successfully.');
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
        $make = Make::find($id);
        return Inertia::render("Make/Edit",compact('make'));
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


        $make = Make::find($id);

    
    
        $make->update([
            'name' => request()->name,

        ]);
    
        return redirect()->route('make.index')->with('success', 'Model updated successfully.');        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     $make = Make::find($id);
     $make->delete();
        return back()->with('success', 'Model deleted successfully.');
    }


}
