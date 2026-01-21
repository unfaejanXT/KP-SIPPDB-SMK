<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roleData = [
            ["name"=> "admin"],
            ["name"=> "user"],
        ];

        foreach ($roleData as $data){
            Role::firstOrCreate($data);
        }
    }
}
