<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure role exists if not already seeded by RoleSeeder, 
        // though DatabaseSeeder usually handles order. 
        // We will assume RoleSeeder runs first.

        $user = User::create([
            'name' => 'Admin',
            'email' => 'test@admin.com',
            'password' => Hash::make('password'),
        ]);

        $user->assignRole('admin');
        
        \App\Models\Staff::create([
            'user_id' => $user->id,
            'nama' => $user->name,
            'jabatan' => 'Administrator',
            'is_active' => true,
        ]);
    }
}
