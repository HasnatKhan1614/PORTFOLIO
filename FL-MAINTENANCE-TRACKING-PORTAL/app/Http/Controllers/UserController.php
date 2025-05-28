<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    public function index(Request $request)
    {
        if (!Auth::user()->can('list-users')) {
            abort(403, 'Unauthorized');
        }
        $companyId = $request->get('company_id');
        $users = User::byCompany()->with('company')->when($companyId, function ($q) use ($companyId) {
            $q->where('company_id', $companyId);
        })->get();
        $companies = Company::all();

        return view('pages.users.index', compact('users', 'companies'));
    }

    public function create()
    {
        $companies = Company::all();
        return view('pages.users.create', compact('companies'));
    }

    public function store(Request $request)
    {
        if (!Auth::user()->can('create-users')) {
            abort(403, 'Unauthorized');
        }
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'company_id' => [
                Auth::user()->hasRole('superadmin') ? 'required' : 'nullable',
                'exists:companies,id'
            ],
            'role' => [
                Auth::user()->hasRole('superadmin') ? 'required' : 'nullable',
                'exists:roles,name',
            ],
        ]);

        $userRole = Auth::user()->hasRole('superadmin');

        if ($userRole) {
            $company_id = $request->company_id;
        } else {
            $company_id = Auth::user()->company_id;
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'company_id' => $company_id,
        ]);

        if ($userRole) {
            $user->assignRole($request->role);
        } else {
            $user->assignRole('employee');
        }


        return response()->json(['success' => true, 'message' => 'User created successfully.']);
    }


    public function edit($id)
    {
        $companies = Company::all();
        $user = User::with('company')->find($id);
        return view('pages.users.edit', compact('companies', 'user'));
    }

    public function update(Request $request, $id)
    {
        if (!Auth::user()->can('edit-users')) {
            abort(403, 'Unauthorized');
        }
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'company_id' => [
                    Auth::user()->hasRole('superadmin') ? 'required' : 'nullable',
                    'exists:companies,id'
                ],
            'role' => [
                Auth::user()->hasRole('superadmin') ? 'required' : 'nullable',
                'exists:roles,name',
            ],
        ]);

        $userRole = Auth::user()->hasRole('superadmin');

        if ($userRole) {
            $company_id = $request->company_id;
        } else {
            $company_id = Auth::user()->company_id;
        }

        $user = User::findOrFail($id);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'company_id' => $company_id,
        ]);

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
            $user->save();
        }

        if ($userRole) {
            $user->syncRoles($request->role);
        } else {
            $user->syncRoles('employee');
        }

        return response()->json(['success' => true, 'message' => 'User updated successfully.']);
    }


    public function destroy($id)
    {
        if (!Auth::user()->can('delete-users')) {
            abort(403, 'Unauthorized');
        }
        User::findOrFail($id)->delete();
        return response()->json(['message' => 'User deleted successfully']);
    }
}
