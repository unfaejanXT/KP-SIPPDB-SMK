<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JenisBerkas;

class JenisBerkasSeeder extends Seeder
{
    public function run()
    {
        $jenis_berkas = [
            [
                'kode_berkas' => 'pas_foto',
                'nama_berkas' => 'Pas Foto Resmi (3x4/4x6)',
                'is_wajib' => true,
                'is_active' => true,
            ],
            [
                'kode_berkas' => 'akta_kelahiran',
                'nama_berkas' => 'Akta Kelahiran',
                'is_wajib' => true,
                'is_active' => true,
            ],
            [
                'kode_berkas' => 'kk',
                'nama_berkas' => 'Kartu Keluarga',
                'is_wajib' => true,
                'is_active' => true,
            ],
            [
                'kode_berkas' => 'ijazah',
                'nama_berkas' => 'Ijazah / SKL',
                'is_wajib' => true,
                'is_active' => true,
            ],
            [
                'kode_berkas' => 'ktp_orangtua',
                'nama_berkas' => 'KTP Orang Tua',
                'is_wajib' => true,
                'is_active' => true,
            ],
            [
                'kode_berkas' => 'kip',
                'nama_berkas' => 'Kartu Indonesia Pintar (KIP)',
                'is_wajib' => false,
                'is_active' => true,
            ],
        ];

        foreach ($jenis_berkas as $jenis) {
            JenisBerkas::create($jenis);
        }
    }
}
