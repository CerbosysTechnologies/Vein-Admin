<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            'name'  => 'User',
            'email' => 'user@mailinator.com',
            'password' => bcrypt('password')
        ];
        User::create($user);

        $admin = [
            ['name'  => 'Admin','email' => 'admin@admin.com','password' =>bcrypt('password')],
            ['name'  =>  'Harshita', 'email' => 'dev19@mailinator.com', 'password' => bcrypt('password')]
        ];
        Admin::insert($admin);

      

       

       

    }
}
