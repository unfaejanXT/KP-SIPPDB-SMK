<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PeriodePPDB;

class PeriodePPDBSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Data periode PPDB untuk tahun 2025
        $periodeData = [
            [
                'kode_periode' => 'PPDB2025A',
                'nama_periode' => 'Gelombang 1 Tahun 2025/2026',
                'tanggal_mulai' => '2025-01-10',
                'tanggal_selesai' => '2025-03-10',
                'tahun_ajaran' => '2025/2026',
                'status' => false, // Tidak Aktif
                'keterangan' => 'Penerimaan peserta didik baru gelombang pertama untuk tahun ajaran 2025/2026',
            ],
            [
                'kode_periode' => 'PPDB2025B',
                'nama_periode' => 'Gelombang 2 Tahun 2025/2026',
                'tanggal_mulai' => '2025-05-01',
                'tanggal_selesai' => '2025-07-01',
                'tahun_ajaran' => '2025/2026',
                'status' => true, // Aktif
                'keterangan' => 'Penerimaan peserta didik baru gelombang kedua untuk tahun ajaran 2025/2026',
            ],
        ];

        // Insert data ke tabel periodeppdb
        foreach ($periodeData as $data) {
            PeriodePPDB::create($data);
        }
    }
}
