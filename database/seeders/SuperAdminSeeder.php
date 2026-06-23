<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        // Clear cached permissions to avoid registry conflicts
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Define ERP permissions grouped by module
        $modules = [
            'Dashboard' => [
                'View Dashboard',
            ],
            'Inventory & Products' => [
                'Products',
                'Discount Products',
                'Category',
                'Sub Category',
                'Brands',
                'Unit',
            ],
            'Purchase & Vendors' => [
                'Purchase',
                'Purchase Return',
                'Vendor',
            ],
            'Inward Gatepass' => [
                'List Inwards',
                'Create Inward Gatepass',
            ],
            'Warehouse & Stock' => [
                'List Warehouse',
                'Warehouse Stock',
                'Stock Transfer',
            ],
            'Sales Operations' => [
                'Sales',
                'Sale Return',
                'Bookings',
                'Customer',
                'Sales Officer',
                'Zone',
            ],
            'Finance & Accounts' => [
                'Char Of Accounts',
                'Narrations',
                'Receipts Voucher',
                'Payment Voucher',
                'Expense Voucher',
                'Transfer Voucher',
                'Account Transfer',
                'Payment In',
                'Payment Out',
                'Other Income',
                'Close Day',
                'Cash Book',
            ],
            'Reports' => [
                'System Reports',
                'Sale Report',
                'Purchase Report',
                'Customer Ledger',
                'Vendor Ledger',
                'Item Stock Report',
                'Dual Party Ledger',
                'Party Balances',
                'Financial Summary',
            ],
            'User Management' => [
                'Create User', 'Edit User', 'Delete User', 'View User',
                'Create Role', 'Edit Role', 'Delete Role', 'View Role',
                'Create Permission', 'Delete Permission', 'View Permission',
                'Manage User Roles', 'Manage Role Permissions',
                'Access Settings',
            ],
        ];

        $allPermissions = [];

        foreach ($modules as $moduleName => $permissions) {
            $this->command->info("Seeding module [{$moduleName}] permissions...");
            foreach ($permissions as $permission) {
                Permission::firstOrCreate([
                    'name' => $permission,
                    'guard_name' => 'web'
                ]);
                $allPermissions[] = $permission;
            }
        }

        // Create or retrieve the 'Super Admin' role (exact match for AuthServiceProvider)
        $superAdminRole = Role::firstOrCreate([
            'name' => 'Super Admin',
            'guard_name' => 'web'
        ]);

        // Sync all system permissions to the 'Super Admin' role
        $superAdminRole->syncPermissions(Permission::all());
        $this->command->info("Successfully synced all " . count($allPermissions) . " permissions to the 'Super Admin' role.");

        // Create or retrieve the Super Admin user
        $superAdminUser = User::firstOrCreate(
            ['email' => 'superadmin@example.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('superadmin'),
                'usertype' => 'admin',
            ]
        );

        // Assign 'Super Admin' role to the user if not already assigned
        if (!$superAdminUser->hasRole('Super Admin')) {
            $superAdminUser->assignRole('Super Admin');
        }

        $this->command->info("Super Admin user ('superadmin@example.com') is set up with full access.");
    }
}
