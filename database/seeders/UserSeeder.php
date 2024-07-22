<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Create roles if they do not exist
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $userRole = Role::firstOrCreate(['name' => 'user']);

        // Insert or update admin user
        $admin = User::updateOrCreate(
            ['email' => 'admin@mail.com'],
            [
                'name' => 'Admin',
                'status' => 'active',
                'email_verified_at' => now(),
                'password' => Hash::make('hana@123'),
            ]
        );
        $admin->syncRoles([$adminRole->name]); // Assign role to admin

        // Insert or update regular user
        $user = User::updateOrCreate(
            ['email' => 'user@mail.com'],
            [
                'name' => 'user',
                'status' => 'active',
                'email_verified_at' => now(),
                'password' => Hash::make('user@123'),
            ]
        );
        $user->syncRoles([$userRole->name]); // Assign role to user
    }
}

