<?php

namespace App\Models;

use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{
    protected $fillables = ['name', 'guard_name', 'created_at', 'updated_at', 'visibility'];

    public function scopeVisibleToRole($query, $role)
    {
        if ($role === 'superAdmin') {
            return $query; // SuperAdmin sees all permissions
        }

        return $query->where('visibility', '!=', 'superAdmin-only');
    }
}
