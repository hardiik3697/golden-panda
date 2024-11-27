<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminPermissions = [
            ['name' => 'role-create', 'guard_name' => 'web', 'visibility' => 'superAdmin-only'],
            ['name' => 'role-edit', 'guard_name' => 'web', 'visibility' => 'superAdmin-only'],
            ['name' => 'role-view', 'guard_name' => 'web', 'visibility' => 'superAdmin-only'],
            ['name' => 'role-delete', 'guard_name' => 'web', 'visibility' => 'superAdmin-only'],
            ['name' => 'permission-create', 'guard_name' => 'web', 'visibility' => 'superAdmin-only'],
            ['name' => 'permission-edit', 'guard_name' => 'web', 'visibility' => 'superAdmin-only'],
            ['name' => 'permission-view', 'guard_name' => 'web', 'visibility' => 'superAdmin-only'],
            ['name' => 'permission-delete', 'guard_name' => 'web', 'visibility' => 'superAdmin-only'],
            ['name' => 'access-view', 'guard_name' => 'web', 'visibility' => 'superAdmin-only'],
            ['name' => 'access-edit', 'guard_name' => 'web', 'visibility' => 'superAdmin-only'],
            ['name' => 'setting-view', 'guard_name' => 'web', 'visibility' => 'superAdmin-only'],
            ['name' => 'setting-edit', 'guard_name' => 'web', 'visibility' => 'superAdmin-only'],
            ['name' => 'admin-create', 'guard_name' => 'web', 'visibility' => 'admin'],
            ['name' => 'admin-edit', 'guard_name' => 'web', 'visibility' => 'admin'],
            ['name' => 'admin-view', 'guard_name' => 'web', 'visibility' => 'admin'],
            ['name' => 'admin-delete', 'guard_name' => 'web', 'visibility' => 'admin'],
            ['name' => 'employee-create', 'guard_name' => 'web', 'visibility' => 'admin'],
            ['name' => 'employee-edit', 'guard_name' => 'web', 'visibility' => 'admin'],
            ['name' => 'employee-view', 'guard_name' => 'web', 'visibility' => 'admin'],
            ['name' => 'employee-delete', 'guard_name' => 'web', 'visibility' => 'admin'],
            ['name' => 'customer-create', 'guard_name' => 'web', 'visibility' => 'all'],
            ['name' => 'customer-edit', 'guard_name' => 'web', 'visibility' => 'all'],
            ['name' => 'customer-view', 'guard_name' => 'web', 'visibility' => 'all'],
            ['name' => 'customer-delete', 'guard_name' => 'web', 'visibility' => 'all'],
            ['name' => 'guest-create', 'guard_name' => 'web', 'visibility' => 'admin'],
            ['name' => 'guest-edit', 'guard_name' => 'web', 'visibility' => 'admin'],
            ['name' => 'guest-view', 'guard_name' => 'web', 'visibility' => 'admin'],
            ['name' => 'guest-delete', 'guard_name' => 'web', 'visibility' => 'admin'],
        ];

        $adminRole = Role::findByName('superAdmin'); // Ensure the role exists

        foreach ($adminPermissions as $permissionData) {
            $permission = Permission::create($permissionData); // Create the permission
            $adminRole->givePermissionTo($permission); // Assign to superAdmin
        }
    }
}
