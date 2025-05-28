<?php

namespace App\Http\Controllers;

use App\Models\MaintenanceRequest;
use App\Models\Building;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MaintenanceRequestController extends Controller
{
    // 📌 Display Maintenance Requests (Index)
    public function index()
    {
        if (!auth()->user()->can('list-maintenance-requests')) {
            abort(403, 'Unauthorized');
        }
        
        $maintenanceRequests = MaintenanceRequest::byCompany()->with(['building', 'company', 'user'])->where('status','!=','finished')->latest()->get();

        
        return view('pages.maintenance_requests.index', compact('maintenanceRequests'));
    }

    public function index_finished()
    {
        if (!auth()->user()->can('list-maintenance-requests')) {
            abort(403, 'Unauthorized');
        }

        $maintenanceRequests = MaintenanceRequest::byCompany()->with(['building', 'company', 'user'])->where('status', '=', 'finished')->latest()->get();


        return view('pages.maintenance_requests.finished_index', compact('maintenanceRequests'));
    }



    // 📌 Show Create Form
    public function create()
    {
        $buildings = Building::byCompany()->get();
        $companies = Company::all();

        return view('pages.maintenance_requests.create', compact('buildings','companies'));
    }

    // 📌 Store Maintenance Request
    public function store(Request $request)
{
    if (!auth()->user()->can('create-maintenance-requests')) {
        abort(403, 'Unauthorized');
    }

    $isAdmin = Auth::user()->hasRole('superadmin', 'admin', 'manager');

    $rules = [
        'title' => 'required',
        'building_id' => 'required',
        'urgency' => 'nullable|in:low,medium,high',
        'description' => 'required',
        'company_id' => ($isAdmin ? 'required' : 'nullable') . '|exists:companies,id',
        'status' => 'required|in:waiting,first contact,started,in progress,finished,unable to complete,quoted',
        'accounting_status' => ($isAdmin ? 'required' : 'nullable') . '|in:awaiting completion,awaiting report,invoice sent,invoice paid,quoted',
    ];

    $validatedData = $request->validate($rules);

    $user = auth()->user();
    $company_id = $isAdmin ? $request->company_id : $user->company_id;

    $validatedData['user_id'] = $user->id;
    $validatedData['status'] = 'waiting'; // Default
    $validatedData['company_id'] = $company_id;
    $validatedData['accounting_status'] = 'awaiting completion'; // Default

    MaintenanceRequest::create($validatedData);

    return response()->json(['message' => 'Maintenance request added successfully']);
}


    public function show($id)
    {
        if (!auth()->user()->can('view-maintenance-requests')) {
            abort(403, 'Unauthorized');
        }
        $maintenanceRequest = MaintenanceRequest::findOrFail($id);

        return view('pages.maintenance_requests.show',compact('maintenanceRequest'));
    }


    // 📌 Show Edit Form
    public function edit($id)
    {
        $maintenanceRequest = MaintenanceRequest::with('building')->findOrFail($id);
        $buildings = Building::all();
        $companies = Company::all();
        return view('pages.maintenance_requests.edit', compact('maintenanceRequest', 'buildings', 'companies'));
    }

    // 📌 Update Maintenance Request
    public function update(Request $request, $id)
    {
        if (!auth()->user()->can('edit-maintenance-requests')) {
            abort(403, 'Unauthorized');
        }

        $user = auth()->user();
        $isSuperAdmin = $user->hasRole('superadmin');
        $isManagerLevel = $user->hasRole('superadmin', 'admin', 'manager');

        // Build validation rules dynamically
        $rules = [
            'title' => 'required',
            'building_id' => 'required|exists:buildings,id',
            'urgency' => 'nullable|in:low,medium,high',
            'description' => 'required|string',
            'company_id' => ($isSuperAdmin ? 'required' : 'nullable') . '|exists:companies,id',
            'status' => 'required|in:waiting,first contact,started,in progress,finished,unable to complete,quoted',
            'accounting_status' => ($isManagerLevel ? 'required' : 'nullable') . '|in:awaiting completion,awaiting report,invoice sent,invoice paid,quoted',
        ];

        $validatedData = $request->validate($rules);

        // Determine the company_id based on user role
        $company_id = $isSuperAdmin ? $request->company_id : $user->company_id;
        $validatedData['company_id'] = $company_id;

        // Find and update the maintenance request
        $maintenanceRequest = MaintenanceRequest::findOrFail($id);
        $maintenanceRequest->update($validatedData);

        return response()->json(['message' => 'Maintenance request updated successfully']);
    }



    // 📌 Delete Maintenance Request
    public function destroy($id)
    {
        if (!auth()->user()->can('delete-maintenance-requests')) {
            abort(403, 'Unauthorized');
        }
        MaintenanceRequest::findOrFail($id)->delete();
        return response()->json(['error' => 'Maintenance request deleted successfully']);
    }
}
