<?php

namespace Tests\Unit\Models;

use App\Models\Periode;
use App\Models\Gelombang;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PeriodeTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_periode()
    {
        $periode = Periode::create([
            'nama_periode' => '2025/2026',
            'tahun_ajaran' => '2025/2026',
            'tanggal_mulai' => '2025-01-01',
            'tanggal_selesai' => '2025-12-31',
            'is_active' => true,
        ]);

        $this->assertDatabaseHas('periodes', ['nama_periode' => '2025/2026']);
        $this->assertTrue($periode->is_active);
    }

    public function test_is_berlaku_method()
    {
        // Active period
        $activePeriode = Periode::create([
            'nama_periode' => 'Active',
            'tahun_ajaran' => '2025/2026',
            'tanggal_mulai' => now()->subDay(),
            'tanggal_selesai' => now()->addDay(),
            'is_active' => true,
        ]);

        $this->assertTrue($activePeriode->isBerlaku());

        // Inactive period (past)
        $pastPeriode = Periode::create([
            'nama_periode' => 'Past',
            'tahun_ajaran' => '2024/2025',
            'tanggal_mulai' => now()->subMonth(),
            'tanggal_selesai' => now()->subWeek(),
            'is_active' => false,
        ]);

        $this->assertFalse($pastPeriode->isBerlaku());
    }

    public function test_periode_has_many_gelombangs()
    {
        $periode = Periode::create([
            'nama_periode' => '2025/2026',
            'tahun_ajaran' => '2025/2026',
            'tanggal_mulai' => '2025-01-01',
            'tanggal_selesai' => '2025-12-31',
            'is_active' => true,
        ]);

        $gelombang = Gelombang::create([
            'nama' => 'Gelombang 1',
            'periode_id' => $periode->id,
            'tahun_ajaran' => '2025/2026',
            'tanggal_mulai' => '2025-01-01',
            'tanggal_selesai' => '2025-02-01',
            'kuota' => 100,
            'is_active' => true,
        ]);

        $this->assertTrue($periode->gelombangs->contains($gelombang));
    }
}
