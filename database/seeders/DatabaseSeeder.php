<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\About;
use App\Models\Owner;
use App\Models\Banner;
use App\Models\Setting;
use App\Models\Headline;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Creating super admin user
        $superAdmin = User::create([
            'fname' => 'Super',
            'lname' => 'Admin',
            'type' => 'supper-admin', 
            'email' => 'supper-admin@shunno.com',
            'phone' => '00000000000',
            'password' => bcrypt('admin'),  
        ]);

        // Creating developer user
        $developer = User::create([
            'fname' => 'Developer',
            'lname' => 'OP',
            'type' => 'dev',
            'email' => 'limon@shunno.com',
            'phone' => '01781342259',
            'password' => bcrypt('developer'),
        ]);

        // Creating roles
        Role::create(['name' => 'Super Admin', 'guard_name' => 'web']);
        Role::create(['name' => 'Teacher', 'guard_name' => 'web']);
        Role::create(['name' => 'Student', 'guard_name' => 'web']);

        // Creating settings
        $setting = Setting::create([
            'site_name' => 'Shunno',
            'site_title' => 'Shunno',
            'logo' => 'logo.png',
            'favicon' => 'favicon.png',
            'email' => 'info@shunno.com',
            'phone' => '00000000000',
            'address' => 'Italy',
            'footer_text' => '© 2021 Shunno. All rights reserved.',
            'newslatter_text' => 'Subscribe to our newsletter',
            'facebook' => 'https://www.facebook.com/',
        ]);

        // Assigning roles to users
        $superAdmin->assignRole('Super Admin');
        $developer->assignRole('Super Admin');

        // Call Permission Seeder
        $this->call(PermissionTableSeeder::class);
    }
}
