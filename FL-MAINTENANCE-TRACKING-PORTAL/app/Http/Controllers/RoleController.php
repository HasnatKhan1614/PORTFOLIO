<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        if (!auth()->user()->can('list-role')) {
            abort(403, 'Unauthorized');
        }
        $roles = Role::all();
        return view('pages.role.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all()->groupBy(function ($perm) {
            $parts = explode(' ', $perm->name);
            return $parts[1] ?? $parts[0]; // fallback to the first word if second not available
        });


        return view('pages.role.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        if (!auth()->user()->can('create-role')) {
            abort(403, 'Unauthorized');
        }
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'array|required',
        ]);

        $role = Role::create(['name' => $request->name]);
        $role->syncPermissions($request->permissions);

        return redirect('/roles')->with('success', 'Role created.');
    }

    public function edit($id)
    {
        
        $role = Role::findOrFail($id);
        $permissions = Permission::all()->groupBy(function ($perm) {
            $parts = explode(' ', $perm->name);
            return $parts[1] ?? $parts[0]; // fallback to the first word if second not available
        });
        $rolePermissions = $role->permissions->pluck('name')->toArray();

        return view('pages.role.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    public function update(Request $request, $id)
    {
        if (!auth()->user()->can('edit-role')) {
            abort(403, 'Unauthorized');
        }
        $role = Role::findOrFail($id);

        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
            'permissions' => 'array|required',
        ]);

        $role->update(['name' => $request->name]);
        $role->syncPermissions($request->permissions);

        return redirect('/roles')->with('success', 'Role updated.');
    }

    public function destroy($id)
    {
        if (!auth()->user()->can('delete-role')) {
            abort(403, 'Unauthorized');
        }
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect('/roles')->with('success', 'Role deleted.');
    }
}
