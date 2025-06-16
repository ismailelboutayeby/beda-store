<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class InitialDataSeeder extends Seeder
{
    public function run(): void
    {
        // Create roles
        $roles = [
            'general_manager',
            'designer',
            'warehouse_manager',
            'atelier_manager',
            'logistic',
            'admin',
            'client'
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        // Create users
        $users = [
            ['name' => 'GM', 'email' => 'gm@example.com', 'role' => 'general_manager'],
            ['name' => 'Designer', 'email' => 'designer@example.com', 'role' => 'designer'],
            ['name' => 'Warehouse', 'email' => 'warehouse@example.com', 'role' => 'warehouse_manager'],
            ['name' => 'Atelier', 'email' => 'atelier@example.com', 'role' => 'atelier_manager'],
            ['name' => 'Logistic', 'email' => 'logistic@example.com', 'role' => 'logistic'],
            ['name' => 'Admin', 'email' => 'admin@example.com', 'role' => 'admin'],
            ['name' => 'Client', 'email' => 'client@example.com', 'role' => 'client'],
        ];

        foreach ($users as $data) {
            $user = User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    'password' => Hash::make('password'), // default password
                ]
            );
            $user->assignRole($data['role']);
        }

        // Create products
        Product::factory()->count(5)->create();

        // Create orders
        $client = User::whereHas('roles', fn ($q) => $q->where('name', 'client'))->first();
        $product = \App\Models\Product::first();

        Order::factory()->count(5)->create([
            'client_id' => $client->id,
            'product_id' => $product->id,
            'status' => 'pending_design'
        ]);
    }
}
