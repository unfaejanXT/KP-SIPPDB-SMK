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
        // Data periode PPDB
        $periodeData = [
            [
                'nama' => 'Gelombang 1 Tahun 2026/2027',
                'tanggal_mulai' => '2026-01-01',
                'tanggal_selesai' => '2026-12-31', // Opened for the whole year for testing
                'tahun_ajaran' => '2026/2027',
            ],
        ];

        // Insert data ke tabel periodeppdb
        foreach ($periodeData as $data) {
            PeriodePPDB::create($data);
        }
    }
}
