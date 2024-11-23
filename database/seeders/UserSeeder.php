<?php

namespace Database\Seeders;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class UserSeeder extends Seeder{

    public function run(){
        $data = [
                    [
                        'firstname' => 'Super',
                        'lastname' => 'Admin',
                        'username' => 'superadmin',
                        'phone' => '7897897891',
                        'email' => 'superadmin@example.com',
                        'role' => 'super'
                    ],
                    [
                        'firstname' => 'Mitul',
                        'lastname' => 'Gajjar',
                        'username' => 'mitulgajjar',
                        'phone' => '7897897892',
                        'email' => 'mitul@example.com',
                        'role' => 'admin'
                    ],
                    [
                        'firstname' => 'HardIIk',
                        'lastname' => 'Patel',
                        'username' => 'hardikpatel',
                        'phone' => '7897897893',
                        'email' => 'hardik@example.com',
                        'role' => 'admin'
                    ],
                    [
                        'firstname' => 'Brijesh',
                        'lastname' => 'Patel',
                        'username' => 'brijeshpatel',
                        'phone' => '7897897893',
                        'email' => 'brijesh@example.com',
                        'role' => 'employee'
                    ],
                    [
                        'firstname' => 'Kiran',
                        'lastname' => 'Patel',
                        'username' => 'kiranpatel',
                        'phone' => '7897897894',
                        'email' => 'kiran@example.com',
                        'role' => 'employee'
                    ],
                    [
                        'firstname' => 'Sani',
                        'lastname' => 'Patel',
                        'username' => 'sanipatel',
                        'phone' => '7897897895',
                        'email' => 'sani@example.com',
                        'role' => 'guest'
                    ],
                    [
                        'firstname' => 'Jaydeep',
                        'lastname' => 'Patel',
                        'username' => 'jaydeeppatel',
                        'phone' => '7897897896',
                        'email' => 'jaydeep@example.com',
                        'role' => 'guest'
                    ]
                ];
        
        foreach($data as $row){
            $user = User::create([
                'firstname' => $row['firstname'],
                'lastname' => $row['lastname'],
                'username' => $row['username'],
                'phone' => $row['phone'],
                'email' => $row['email'],
                'password' => bcrypt('Admin@123'),
                'photo' => 'user-icon.png',
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => 1,
                'updated_at' => date('Y-m-d H:i:s'),
                'updated_by' => 1
            ]);        

            $user->assignRole(Role::findByName($row['role']));
        }

        $file_to_upload = public_path().'/uploads/users/';
        if (!File::exists($file_to_upload))
            File::makeDirectory($file_to_upload, 0777, true, true);

        if(file_exists(public_path('/assets/images/users/profile-pic.png')) && !file_exists(public_path('/uploads/users/user-icon.png')) ){
            File::copy(public_path('/assets/images/users/profile-pic.png'), public_path('/uploads/users/user-icon.png'));
        }
    }
}