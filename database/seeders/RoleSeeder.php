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
        // 1. Administrator -> admin
        // 2. Panitia PPDB -> panitia_ppdb
        // 3. Kepala Sekolah -> kepala_sekolah
        // 4. Calon Siswa -> user
        
        $roleData = [
            ["name"=> "operator_sekolah"],
            ["name"=> "calon_siswa"],
            ["name"=> "staff_ppdb"],
            ["name"=> "kepala_sekolah"],
        ];

        foreach ($roleData as $data){
            Role::firstOrCreate($data);
        }
    }
}
