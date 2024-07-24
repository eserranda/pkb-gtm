<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Buat beberapa role jika belum ada
        $super_admin = Role::firstOrCreate([
            'name' => 'super_admin',
            'description' => 'Super Admin'
        ]);
        $userRole = Role::firstOrCreate([
            'name' => 'user',
            'description' => 'Regular User'
        ]);

        // Buat user baru
        $admin = User::create([
            'name' => 'Super Admin',
            'username' => 'super_admin',
            'email' => 'super_admin@localhost.com',
            'password' => Hash::make('password'),
        ]);

        $user = User::create([
            'name' => 'Regular User',
            'username' => 'user',
            'email' => 'user@localhost.com',
            'password' => Hash::make('password'),
        ]);

        // Hubungkan user dengan role
        $admin->roles()->attach($super_admin);
        $user->roles()->attach($userRole);
    }
}
