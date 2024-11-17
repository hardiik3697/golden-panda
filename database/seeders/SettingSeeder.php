<?php

namespace Database\Seeders;
use App\Models\Setting;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class SettingSeeder extends Seeder{
    public function run(){
        $general = [
            'SITE_TITLE' => 'Golden Panda', 
            'SITE_TITLE_SF' => 'GP', 
            'CONTACT_NUMBER' => '+91-9898000001',
            'MAIN_CONTACT_NUMBER' => '+91-9898000002',
            'CONTACT_EMAIL' => 'info@goldenpanda.com',
            'MAIN_CONTACT_EMAIL' => 'info@goldenpanda.com',
            'CONTACT_ADDRESS' => 'Plot No:22, Gulmohar Co.Op,So Ltd, Shimpoli Road, Borivali(West), Mumbai-400092',
            'MAIN_CONTACT_ADDRESS' => 'Branch/Courier Address:- D-1402 Sun South Park, South Bopal, Ahmedabad-38008'
        ];

        foreach($general as $key => $value){
            Setting::create([
                'key' => $key,
                'value' => $value,
                'type' => 'general',
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => 1,
                'updated_at' => date('Y-m-d H:i:s'),
                'updated_by' => 1
            ]);
        }

        $smtp = [
            'MAIL_MAILER' => 'smtp',
            'MAIL_HOST' => 'mail.goldenpanda.com',
            'MAIL_PORT' => '26',
            'MAIL_USERNAME' => 'test@goldenpanda.com',
            'MAIL_PASSWORD' => 'Test@goldenpanda123',
            'MAIL_ENCRYPTION' => 'tls',
            'MAIL_FROM_ADDRESS' => 'test@goldenpanda.com',
            'MAIL_FROM_NAME' => 'Kripton Tech'
        ];

        foreach($smtp as $key => $value){
            Setting::create([
                'key' => $key,
                'value' => $value,
                'type' => 'smtp',
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => 1,
                'updated_at' => date('Y-m-d H:i:s'),
                'updated_by' => 1
            ]);
        }

        $sms = [
            'SMS_NAME' => 'Golden Panda',
            'SMS_NUMBER' => '+91-8000080000'
        ];

        foreach($sms as $key => $value){
            Setting::create([
                'key' => $key,
                'value' => $value,
                'type' => 'sms',
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => 1,
                'updated_at' => date('Y-m-d H:i:s'),
                'updated_by' => 1
            ]);
        }

        $social = [
            'FACEBOOK' => 'www.facebook.com/goldenpanda',
            'INSTAGRAM' => 'www.instagram.com/goldenpanda',
            'YOUTUBE' => 'www.youtube.com/goldenpanda',
            'GOOGLE' => 'www.google.com/goldenpanda'
        ];

        foreach($social as $key => $value){
            Setting::create([
                'key' => $key,
                'value' => $value,
                'type' => 'social',
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => 1,
                'updated_at' => date('Y-m-d H:i:s'),
                'updated_by' => 1
            ]);
        }

        $logo = [
            'FEVICON' => 'fevicon.png',
            'LOGO' => 'logo.png',
            'SMALL_LOGO' => 'small_logo.png'
        ];

        foreach($logo as $key => $value){
            Setting::create([
                'key' => $key,
                'value' => $value,
                'type' => 'logo',
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => 1,
                'updated_at' => date('Y-m-d H:i:s'),
                'updated_by' => 1
            ]);
        }

        $folder_to_upload = public_path().'/uploads/logo/';

        if (!\File::exists($folder_to_upload)) {
            \File::makeDirectory($folder_to_upload, 0777, true, true);
        }

        if(file_exists(public_path('/dummy/fevicon.png')) && !file_exists(public_path('/uploads/logo/fevicon.png')) ){
            File::copy(public_path('/dummy/fevicon.png'), public_path('/uploads/logo/fevicon.png'));
        }

        if(file_exists(public_path('/dummy/logo.png')) && !file_exists(public_path('/uploads/logo/logo.png')) ){
            File::copy(public_path('/dummy/logo.png'), public_path('/uploads/logo/logo.png'));
        }

        if(file_exists(public_path('/dummy/small_logo.png')) && !file_exists(public_path('/uploads/logo/small_logo.png')) ){
            File::copy(public_path('/dummy/small_logo.png'), public_path('/uploads/logo/small_logo.png'));
        }
    }
}