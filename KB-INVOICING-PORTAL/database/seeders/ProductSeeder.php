<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            'Single Domain Hosting',
            'Multi Domain Hosting',
            'Cloud Hosting',
            'Reseller Linux Hosting (USA)',
            'Enterprise Email',
            'Business Email',
            'VPS',
            'Dedicated Server',
            'SiteLock',
            'Google Workspace',
            'CodeGuard',
            'SSL Certificate',
        ];

        foreach ($products as $product) {
            DB::table('products')->insert([
                'name' => $product,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
