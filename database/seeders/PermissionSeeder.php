<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superPermissions = [
            'role-create',
            'role-read',
            'role-update',
            'role-delete',
            'permission-create',
            'permission-read',
            'permission-update',
            'permission-delete',
            'setting-read',
            'setting-update',
            'access-read',
            'access-update',
        ];

        $adminPermissions = [
            'user-create',
            'user-read',
            'user-update',
            'user-delete'
        ];

        $employeePermissions = [];
        $guestPermissions = [];

        $permissions = array_merge($adminPermissions, $superPermissions);
        // $permissions = array_merge($admin_permissions, $super_permissions, $employee_permissions, $guest_permissions);

        foreach ($permissions as $permission) 
        {
            Permission::create(['name' => $permission, 'guard_name' => 'web']);
        }

        $super = Role::findByName('super');
        $super->givePermissionTo($permissions);

        $admin = Role::findByName('admin');
        $admin->givePermissionTo($adminPermissions);
    }
}
