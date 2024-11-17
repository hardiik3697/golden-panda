<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class AssignRolesSeeder extends Seeder
{
    public function run()
    {
        $user = User::find(1); // Replace '1' with the actual user ID
        $user->assignRole('superAdmin'); // Assign superAdmin role to the user
    }
}
