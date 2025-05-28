<?php


namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            // company
            'create-company',
            'edit-company',
            'delete-company',
            'list-company',
            'report-company',
            // building
            'create-building',
            'edit-building',
            'delete-building',
            'list-building',
            // maintenance-requests
            'create-maintenance-requests',
            'edit-maintenance-requests',
            'delete-maintenance-requests',
            'list-maintenance-requests',
            'view-maintenance-requests',
            // maintenance-request-items
            'create-maintenance-request-items',
            'edit-maintenance-request-items',
            'delete-maintenance-request-items',
            'list-maintenance-request-items',
            // role
            'create-role',
            'edit-role',
            'delete-role',
            'list-role',
            // users
            'create-users',
            'edit-users',
            'delete-users',
            'list-users',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $roles = ['developer', 'superadmin', 'admin', 'employee','manager'];
        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        // Assign all to developer
        Role::findByName('developer')->syncPermissions(Permission::all());

        // Assign all except "role" permissions to superadmin
        $superadminPermissions = Permission::whereNotIn('name', [
            'create-role',
            'edit-role',
            'delete-role',
            'list-role'
        ])->get();
        Role::findByName('superadmin')->syncPermissions($superadminPermissions);

        // Assign selected to admin
        $adminPermissions = [
            'create-building',
            'edit-building',
            'delete-building',
            'list-building',
            'create-maintenance-requests',
            'edit-maintenance-requests',
            'delete-maintenance-requests',
            'list-maintenance-requests',
            'view-maintenance-requests',
            'create-maintenance-request-items',
            'edit-maintenance-request-items',
            'delete-maintenance-request-items',
            'list-maintenance-request-items',
            'create-users',
            'edit-users',
            'delete-users',
            'list-users',
        ];
        Role::findByName('admin')->syncPermissions($adminPermissions);

        // Assign limited to employee
        $employeePermissions = [
            'create-maintenance-requests',
            'edit-maintenance-requests',
            'delete-maintenance-requests',
            'list-maintenance-requests',
            'view-maintenance-requests',
            'create-maintenance-request-items',
            'edit-maintenance-request-items',
            'delete-maintenance-request-items',
            'list-maintenance-request-items',
        ];
        Role::findByName('employee')->syncPermissions($employeePermissions);

        // Assign limited to manager
        $managerPermissions = [
            'create-maintenance-requests',
            'edit-maintenance-requests',
            'delete-maintenance-requests',
            'list-maintenance-requests',
            'view-maintenance-requests',
            'create-maintenance-request-items',
            'edit-maintenance-request-items',
            'delete-maintenance-request-items',
            'list-maintenance-request-items',
        ];
        Role::findByName('manager')->syncPermissions($managerPermissions);

        // Create users
        $users = [
            ['name' => 'Developer', 'username' => 'developer', 'email' => 'developer@example.com', 'password' => 'password', 'role' => 'developer'],
            ['name' => 'Super Admin', 'username' => 'superadmin', 'email' => 'superadmin@example.com', 'password' => 'password', 'role' => 'superadmin'],
            ['name' => 'Admin', 'username' => 'admin', 'email' => 'admin@example.com', 'password' => 'password', 'role' => 'admin'],
            ['name' => 'Employee', 'username' => 'employee', 'email' => 'employee@example.com', 'password' => 'password', 'role' => 'employee'],
            ['name' => 'Manager', 'username' => 'manager', 'email' => 'manager@example.com', 'password' => 'password', 'role' => 'manager'],
        ];

        foreach ($users as $data) {
            $user = User::firstOrCreate([
                'email' => $data['email']
            ], [
                'name' => $data['name'],
                'username' => $data['username'],
                'company_id' => 1,
                'password' => Hash::make($data['password']),
                'email_verified_at' => now(),
            ]);

            $user->assignRole($data['role']);
        }
    }
}
