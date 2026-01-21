<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Gelombang;
use App\Models\Periode;

class PeriodePPDBSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create a Periode first
        $periode = Periode::create([
            'nama_periode' => 'PPDB Tahun Ajaran 2026/2027',
            'tahun_ajaran' => '2026/2027',
            'tanggal_mulai' => '2026-01-01',
            'tanggal_selesai' => '2026-12-31',
            'is_active' => true,
        ]);

        // Data periode PPDB (now Gelombang)
        $periodeData = [
            [
                'nama' => 'Gelombang 1 Tahun 2026/2027',
                'tanggal_mulai' => '2026-01-01',
                'tanggal_selesai' => '2026-12-31',
                'tahun_ajaran' => '2026/2027',
                'periode_id' => $periode->id,
                'kuota' => 100,
                'is_active' => true,
            ],
        ];

        // Insert data ke tabel gelombangs
        foreach ($periodeData as $data) {
            Gelombang::create($data);
        }
    }
}
