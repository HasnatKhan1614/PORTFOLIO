<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {


        // // Ensure roles exist
        // Role::firstOrCreate(['name' => 'admin']);
        // Role::firstOrCreate(['name' => 'user']);

        // // Create Admin User
        // $admin = User::factory()->create([
        //     'name' => 'Admin User',
        //     'username' => 'admin',
        //     'email' => 'admin@example.com',
        //     'password' => bcrypt('password'),
        // ]);

        // // Assign Admin Role
        // $admin->assignRole('admin');
        $this->call([
            PermissionSeeder::class,
        ]);
    }
}
