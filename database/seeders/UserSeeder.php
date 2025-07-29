<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = user::create([
            'username'=> '1234567890',
            'nohp'=> '081320427434',
            'password'=> bcrypt('password'),
            
        ])->assignRole('admin');

    }
}
