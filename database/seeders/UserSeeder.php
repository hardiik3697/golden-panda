<?php

namespace Database\Seeders;
use App\Models\User;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class UserSeeder extends Seeder{

    public function run(){
        $data = [
            [
                'name' => 'Super Admin',
                'phone' => '7897897891',
                'email' => 'superadmin@goldenpanda.com'
            ],
            [
                'name' => 'Gajjar Mitul',
                'phone' => '7897897892',
                'email' => 'mitul@goldenpanda.com'
            ],
            [
                'name' => 'HardIk Patel',
                'phone' => '7897897893',
                'email' => 'hardik@goldenpanda.com'
            ]
        ];
        
        foreach($data as $row){
            $user = User::create([
                'name' => $row['name'],
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
        }

        $file_to_upload = public_path().'/uploads/users/';
        if (!File::exists($file_to_upload))
            File::makeDirectory($file_to_upload, 0777, true, true);

        if(file_exists(public_path('/assets/images/users/profile-pic.png')) && !file_exists(public_path('/uploads/users/user-icon.png')) ){
            File::copy(public_path('/assets/images/users/profile-pic.png'), public_path('/uploads/users/user-icon.png'));
        }
    }
}