<?php

namespace App\Models;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role as SpatiePermission;

class Role extends SpatiePermission
{
    protected $fillables = ['name', 'guard_name', 'created_at', 'updated_at'];

    public static function insertOrUpdate(Request $request) {
        $curd = [
            'name' => $request->name,
            'guard_name' => 'web',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        if ($request->has('id')) {
            $role = Role::where('id', $request->input('id'))->update($curd);
            if ($role) {
                $role->syncPermissions($request->permissions);
                return true;
            }
        } else {
            $role = Role::create($curd);
            if ($role) {
                $role->syncPermissions($request->permissions);
                return true;
            }
        }
        return false;
    }
}
