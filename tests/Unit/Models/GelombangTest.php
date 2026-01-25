<?php

namespace Tests\Unit\Models;

use App\Models\Gelombang;
use App\Models\Periode;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GelombangTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_gelombang()
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

        $this->assertDatabaseHas('gelombangs', ['nama' => 'Gelombang 1']);
        $this->assertTrue($gelombang->is_active);
    }

    public function test_gelombang_is_berlaku()
    {
        $periode = Periode::create([ // Need valid periode for foreign key
            'nama_periode' => 'Test', 'tahun_ajaran' => '2020/2021', 
            'tanggal_mulai' => '2020-01-01', 'tanggal_selesai' => '2021-12-31', 'is_active' => 1
        ]);
        
        $active = Gelombang::create([
            'nama' => 'Active',
            'periode_id' => $periode->id,
            'tahun_ajaran' => '2020/2021',
            'tanggal_mulai' => now()->subDay(),
            'tanggal_selesai' => now()->addDay(),
            'kuota' => 100,
            'is_active' => true,
        ]);

        $this->assertTrue($active->isBerlaku());
    }
}
