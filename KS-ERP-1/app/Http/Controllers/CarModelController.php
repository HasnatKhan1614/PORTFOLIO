<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;
use App\Models\{
    CarModel,
    Make,
};

class CarModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $car_models = CarModel::with('make')->get();

        return Inertia::render("CarModel/Index", compact('car_models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $makes = Make::all();
        return Inertia::render("CarModel/Create", compact('makes'));
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
            'make_id' => 'required',
        ]);
    
        if ($validator->fails()) {
            return $validator->errors();
        }
    
        $car_model = CarModel::create([
            'name' => request()->name,
            'make_id' => request()->make_id,
        ]);
    
        return redirect()->route('car-model.index')->with('success', 'Product created successfully.');
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
        $car_model = CarModel::find($id);
        $makes = Make::all();

        return Inertia::render("CarModel/Edit",compact('car_model','makes'));
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
            'make_id' => 'required',

        ]);
    
        if ($validator->fails()) {
            return $validator->errors();
        }

        $car_model = CarModel::find($id);

    
    
        $car_model->update([
            'name' => request()->name,
            'make_id' => request()->make_id,

        ]);
    
        return redirect()->route('car-model.index')->with('success', 'Model updated successfully.');        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     $car_model = CarModel::find($id);
     $car_model->delete();
        return back()->with('success', 'Model deleted successfully.');
    }


}
