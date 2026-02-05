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
        // 1. Operator Sekolah
        $operator = User::create([
            'name' => 'Operator Sekolah',
            'email' => 'operatorsekolah@gmail.com',
            'password' => Hash::make('password'),
        ]);
        $operator->assignRole('operator_sekolah');
        \App\Models\Staff::create([
            'user_id' => $operator->id,
            'nama' => $operator->name,
            'jabatan' => 'Operator Sekolah',
            'is_active' => true,
        ]);

        // 2. Staff PPDB
        $staff = User::create([
            'name' => 'Staff PPDB',
            'email' => 'staffppdb@gmail.com',
            'password' => Hash::make('password'),
        ]);
        $staff->assignRole('staff_ppdb');
        \App\Models\Staff::create([
            'user_id' => $staff->id,
            'nama' => $staff->name,
            'jabatan' => 'Staff PPDB',
            'is_active' => true,
        ]);

        // 3. Kepala Sekolah
        $kepala = User::create([
            'name' => 'Kepala Sekolah',
            'email' => 'kepalasekolah@gmail.com',
            'password' => Hash::make('password'),
        ]);
        $kepala->assignRole('kepala_sekolah');
        \App\Models\Staff::create([
            'user_id' => $kepala->id,
            'nama' => $kepala->name,
            'jabatan' => 'Kepala Sekolah',
            'is_active' => true,
        ]);
    }
}
