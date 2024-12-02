<?php

namespace Database\Seeders;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class UserSeeder extends Seeder
{

    public function run()
    {
        $data = [
            [
                'name' => 'Super',
                'email' => 'superadmin@example.com'
            ],
            [
                'name' => 'hardik',
                'email' => 'hardik@example.com'
            ]
            //             [
            //                 'firstname' => 'Super',
            //                 'lastname' => 'Admin',
            //                 'username' => 'super',
            //                 'phone' => '7897897891',
            //                 'email' => 'superadmin@example.com',
            //                 'role' => 'super'
            //             ],
            //             [
            //                 'firstname' => 'Mitul',
            //                 'lastname' => 'admin',
            //                 'username' => 'mituladmin',
            //                 'phone' => '7897897892',
            //                 'email' => 'mitul@admin.com',
            //                 'role' => 'admin'
            //             ],
            //             [
            //                 'firstname' => 'Hardik',
            //                 'lastname' => 'admin',
            //                 'username' => 'hardikadmin',
            //                 'phone' => '7897897893',
            //                 'email' => 'hardik@admin.com',
            //                 'role' => 'admin'
            //             ],
            //             [
            //                 'firstname' => 'Mitul',
            //                 'lastname' => 'manager',
            //                 'username' => 'mitulmanager',
            //                 'phone' => '7897890001',
            //                 'email' => 'mitul@manager.com',
            //                 'role' => 'manager'
            //             ],
            //             [
            //                 'firstname' => 'Hardik',
            //                 'lastname' => 'manager',
            //                 'username' => 'hardikmanager',
            //                 'phone' => '7897890002',
            //                 'email' => 'hardik@manager.com',
            //                 'role' => 'manager'
            //             ],
            //             [
            //                 'firstname' => 'Mitul',
            //                 'lastname' => 'employee',
            //                 'username' => 'mitulemployee',
            //                 'phone' => '7897890011',
            //                 'email' => 'mitul@employee.com',
            //                 'role' => 'employee'
            //             ],
            //             [
            //                 'firstname' => 'Hardik',
            //                 'lastname' => 'employee',
            //                 'username' => 'hardikemployee',
            //                 'phone' => '7897890022',
            //                 'email' => 'hardik@employee.com',
            //                 'role' => 'employee'
            //             ],
            //             [
            //                 'firstname' => 'Mitul',
            //                 'lastname' => 'guest',
            //                 'username' => 'mitulguest',
            //                 'phone' => '7897890111',
            //                 'email' => 'mitul@guest.com',
            //                 'role' => 'guest'
            //             ],
            //             [
            //                 'firstname' => 'Hardik',
            //                 'lastname' => 'guest',
            //                 'username' => 'hardikguest',
            //                 'phone' => '7897890222',
            //                 'email' => 'hardik@guest.com',
            //                 'role' => 'guest'
            //             ]
        ];

        foreach ($data as $row) {
            $user = User::create([
                'name' => $row['name'],
                'email' => $row['email'],
                'password' => bcrypt('Admin@123')
            ]);
            // $user = User::create([
            //     'firstname' => $row['firstname'],
            //     'lastname' => $row['lastname'],
            //     'username' => $row['username'],
            //     'phone' => $row['phone'],
            //     'email' => $row['email'],
            //     'password' => bcrypt('Admin@123'),
            //     'photo' => 'user-icon.png',
            //     'status' => 'active',
            //     'created_at' => date('Y-m-d H:i:s'),
            //     'created_by' => 1,
            //     'updated_at' => date('Y-m-d H:i:s'),
            //     'updated_by' => 1
            // ]);        

            // $user->assignRole(Role::findByName($row['role']));
        }

        // $file_to_upload = public_path().'/uploads/users/';
        // if (!File::exists($file_to_upload))
        //     File::makeDirectory($file_to_upload, 0777, true, true);

        // if(file_exists(public_path('/dummy/profile-pic.png')) && !file_exists(public_path('/uploads/users/user-icon.png')) ){
        //     File::copy(public_path('/dummy/profile-pic.png'), public_path('/uploads/users/user-icon.png'));
        // }
    }
}
