<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'lastname' => "admin",
            'firstname' => "admin",
            'gender' => "male",
            'adresse' => ".",
            'NContract' => 0,
            'NClient' => 0,
            'img' => "C:\Users\Msi\Desktop\backend-consomation\public\happy.jpg",
            'email' => "admin@gmail.com",
            'password' => bcrypt("adminpass"),
        ]);
        DB::table('users')->insert([
            'lastname' => "Mzari",
            'firstname' => "Houda",
            'gender' => "Female",
            'adresse' => "142 street",
            'NContract' => 9852,
            'NClient' => 46598,
            'img' => "C:\Users\Msi\Desktop\backend-consomation\public\happy.jpg",
            'email' => "houda.mzari1999@gmail.com",
            'password' => bcrypt("Houdita123."),
        ]);
    }
}
