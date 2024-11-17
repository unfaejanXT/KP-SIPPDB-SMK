<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jurusan;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Sample data for Jurusan
        $jurusanData = [
            [
                'kode' => 'AGRIBISNIS01',  // Kode jurusan
                'nama' => 'Agribisnis Pengolahan Hasil Pertanian', // Nama jurusan
                'deskripsi' => 'Program studi yang mempelajari pengolahan hasil pertanian dan pengelolaan bisnis di sektor pertanian.', // Deskripsi
                'kuota' => 30, // Kuota pendaftaran
                'status' => 'aktif', // Status jurusan
            ],
            [
                'kode' => 'PERBANKANSY01',  // Kode jurusan
                'nama' => 'Perbankan Syariah', // Nama jurusan
                'deskripsi' => 'Program studi yang mempelajari prinsip-prinsip perbankan yang sesuai dengan hukum Syariah Islam.', // Deskripsi
                'kuota' => 25, // Kuota pendaftaran
                'status' => 'aktif', // Status jurusan
            ]
        ];

        // Insert each jurusan data into the table
        foreach ($jurusanData as $data) {
            Jurusan::create($data);
        }
    }
}
