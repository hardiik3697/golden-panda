<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder{
    /**
     * Run the database seeds.
     */
    public function run(): void{        
        $super_permissions = [
            'role-create',
            'role-edit',
            'role-view',
            'role-delete',
            'permission-create',
            'permission-edit',
            'permission-view',
            'permission-delete',
            'setting-view',
            'setting-edit',
            'access-view',
            'access-edit',
        ];
        
        $admin_permissions = [
            'user-create',
            'user-edit',
            'user-view',
            'user-delete'
        ];

        $employee_permissions = [];
        $guest_permissions = [];

        $permissions = array_merge($admin_permissions, $super_permissions);
        // $permissions = array_merge($admin_permissions, $super_permissions, $employee_permissions, $guest_permissions);

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'web']);
        }

        $super = Role::findByName('super');
        $super->givePermissionTo($permissions);

        $admin = Role::findByName('admin');
        $admin->givePermissionTo($admin_permissions);
    }
}
