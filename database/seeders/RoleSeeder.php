<?php

namespace Database\Seeders;

use App\Models\PeriodePPDB;
use App\Models\Role;
use App\Models\roles;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            Role::create($data);
        }
    }
}
