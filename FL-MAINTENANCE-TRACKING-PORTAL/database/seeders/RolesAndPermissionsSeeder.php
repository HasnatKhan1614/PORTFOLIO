<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create roles
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $userRole = Role::firstOrCreate(['name' => 'user']);

        // Define models and actions
        $models = ['Company', 'Building', 'MaintenanceRequest', 'MaintenanceRequestItems', 'Users'];
        $actions = ['create', 'read', 'update', 'delete', 'show'];

        // Create permissions
        foreach ($models as $model) {
            foreach ($actions as $action) {
                Permission::firstOrCreate(['name' => "$action $model"]);
            }
        }

        // Assign all permissions to admin role
        $adminRole->syncPermissions(Permission::all());
    }
}