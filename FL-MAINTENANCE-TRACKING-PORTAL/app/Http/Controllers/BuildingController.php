<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Building;
use Illuminate\Support\Facades\Auth;

class BuildingController extends Controller {
    public function index() {

        if (!auth()->user()->can('list-building')) {
            abort(403, 'Unauthorized');
        }
        $buildings = Building::byCompany()->get();
        return view('pages.buildings.index', compact('buildings'));
    }

    public function create() {

        return view('pages.buildings.create');
    }

    public function store(Request $request)
    {
        if (!auth()->user()->can('create-building')) {
            abort(403, 'Unauthorized');
        }

        $isAdmin = Auth::user()->hasRole('superadmin');

        $rules = [
            'name' => 'required',
            'tax_number' => 'required|unique:buildings',
            'address' => 'required',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ];

        if ($isAdmin) {
            $rules['company_id'] = 'required|exists:companies,id';
        }

        $validatedData = $request->validate($rules);

        $validatedData['company_id'] = $isAdmin
            ? $request->company_id
            : Auth::user()->company_id;

        $building = Building::create($validatedData);

        return response()->json([
            'message' => 'Building added successfully',
            'building' => $building
        ]);
    }



    public function edit($id) {

        $building = Building::findOrFail($id);
        return view('pages.buildings.edit', compact('building'));
    }

    public function update(Request $request, $id)
    {
        if (!auth()->user()->can('edit-building')) {
            abort(403, 'Unauthorized');
        }

        $isAdmin = Auth::user()->hasRole('superadmin', 'admin', 'manager');

        $rules = [
            'name' => 'required',
            'tax_number' => 'required',
            'address' => 'required',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ];

        if ($isAdmin) {
            $rules['company_id'] = 'required|exists:companies,id';
        }

        $validatedData = $request->validate($rules);

        $building = Building::findOrFail($id);

        $validatedData['company_id'] = $isAdmin
            ? $request->company_id
            : auth()->user()->company_id;

        $building->update($validatedData);

        return response()->json([
            'message' => 'Building updated successfully',
            'building' => $building
        ]);
    }




    public function destroy($id) {
        if (!auth()->user()->can('delete-building')) {
            abort(403, 'Unauthorized');
        }
        Building::findOrFail($id)->delete();
        return response()->json(['message' => 'Building deleted successfully']);
    }
}

