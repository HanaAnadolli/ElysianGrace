<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert admin user into users table
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'role' => 'admin',
            'status' => 'active',
            'email_verified_at' => now(),
            'password' => Hash::make('hana@123'), // Replace 'password' with desired password
            'remember_token' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
