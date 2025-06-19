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
        // DRY: Merge all roles into one array
        $allRoles = array_unique(array_merge([
            'general_manager', 'designer', 'warehouse_manager', 'atelier_manager', 'logistic', 'admin', 'client'
        ], ['Admin', 'Stock', 'Designer', 'Logistic', 'Viewer']));
        foreach ($allRoles as $role) {
            \App\Models\Role::firstOrCreate([
                'name' => $role,
                'guard_name' => 'web',
            ]);
        }

        // DRY: Create users and assign roles
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
            $user = \App\Models\User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    'password' => \Illuminate\Support\Facades\Hash::make('password'),
                ]
            );
            $user->assignRole($data['role']);
        }

        // DRY: Seed products and orders
        \App\Models\Product::factory()->count(5)->create();
        $client = \App\Models\User::whereHas('roles', fn ($q) => $q->where('name', 'client'))->first();
        $product = \App\Models\Product::first();
        \App\Models\Order::factory()->count(5)->create([
            'client_id' => $client->id,
            'product_id' => $product->id,
            'status' => 'pending_design'
        ]);

        // DRY: Seed permissions
        $defaultPermissions = [
            'view_products', 'add_products', 'edit_products', 'delete_products',
            'view_orders', 'edit_orders', 'delete_orders',
            'view_invoices', 'edit_invoices', 'delete_invoices',
            'manage_users', 'manage_roles', 'manage_permissions',
        ];
        foreach ($defaultPermissions as $permission) {
            \App\Models\Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }

        // DRY: Assign permissions to roles
        $rolePermissions = [
            'Admin' => $defaultPermissions,
            'Stock' => ['view_products', 'add_products', 'delete_products'],
            'Designer' => ['view_products'],
            'Logistic' => ['validate_orders'],
            'Viewer' => ['view_products'],
        ];
        foreach ($rolePermissions as $roleName => $permissions) {
            $role = \App\Models\Role::where('name', $roleName)->first();
            if ($role) {
                $permissionIds = \App\Models\Permission::whereIn('name', $permissions)->pluck('id');
                $role->permissions()->syncWithoutDetaching($permissionIds);
            }
        }

        // Give admin all permissions
        $adminRole = \App\Models\Role::where('name', 'Admin')->first();
        if ($adminRole) {
            $allPermissions = \App\Models\Permission::pluck('id');
            $adminRole->permissions()->syncWithoutDetaching($allPermissions);
        }
    }
}
