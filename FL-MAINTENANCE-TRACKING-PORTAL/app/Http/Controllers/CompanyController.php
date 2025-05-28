<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\MaintenanceRequest;

class CompanyController extends Controller {
    public function index() {
        if (!auth()->user()->can('list-company')) {
            abort(403, 'Unauthorized');
        }
        $companies = Company::all();
        return view('pages.companies.index', compact('companies'));
    }

    public function create() {
        return view('pages.companies.create');
    }

    public function store(Request $request) {
        if (!auth()->user()->can('create-company')) {
            abort(403, 'Unauthorized');
        }
        $request->validate([
            'name' => 'required',
            'tax_number' => 'required|unique:companies',
            'email' => 'required|email|unique:companies',
            'address' => 'required'
        ]);

        $company = Company::create($request->all());
        return response()->json(['message' => 'Company added successfully', 'company' => $company]);
    }

    public function show($id)
    {
        if (!auth()->user()->can('report-company')) {
            abort(403, 'Unauthorized');
        }
        $company = Company::findOrFail($id);

        // Get all related data in a single optimized query
        $buildings = $company->buildings()->select('id', 'name', 'address')->get();
        $maintenanceRequests = $company->maintenanceRequests()
            ->with(['building:id,name,longitude,latitude'])
            ->get(['id', 'building_id', 'urgency', 'status', 'accounting_status']);


        // Extract maintenance locations for the map
        $mapData = $company->buildings->map(function ($building) {
            return $building ? [
                'id' => $building,
                'building' => $building->name ?? 'N/A',
                'latitude' => $building->latitude,
                'longitude' => $building->longitude,
            ] : null;
        })->filter();



        return view('pages.companies.show', compact('company', 'buildings', 'maintenanceRequests', 'mapData'));
    }


    public function edit($id) {
        
        $company = Company::findOrFail($id);
        return view('pages.companies.edit', compact('company'));
    }

    public function update(Request $request, $id) {
        if (!auth()->user()->can('edit-company')) {
            abort(403, 'Unauthorized');
        }
        $request->validate([
            'name' => 'required',
            'tax_number' => 'required',
            'email' => 'required|email',
            'address' => 'required'
        ]);

        $company = Company::findOrFail($id);
        $company->update($request->all());
        return response()->json(['message' => 'Company updated successfully']);
    }

    public function destroy($id)
    {
        if (!auth()->user()->can('delete-company')) {
            abort(403, 'Unauthorized');
        }

        $company = Company::findOrFail($id);

        // Example: Check for related users or other relations
        if ($company->maintenanceRequests()->exists() || $company->projects()->exists() || $company->users()->exists()) {
            return response()->json([
                'error' => 'Cannot delete company with related users.'
            ]);
        }

        $company->delete();

        return response()->json(['message' => 'Company deleted successfully']);
    }

}
