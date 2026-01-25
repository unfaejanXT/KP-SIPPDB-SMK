<?php

namespace Tests\Unit\Models;

use App\Models\JenisBerkas;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class JenisBerkasTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_jenis_berkas()
    {
        $jenis = JenisBerkas::create([
            'kode_berkas' => 'KK',
            'nama_berkas' => 'Kartu Keluarga',
            'is_wajib' => true,
            'is_active' => true,
        ]);

        $this->assertDatabaseHas('jenis_berkas', ['kode_berkas' => 'KK']);
        $this->assertTrue($jenis->is_wajib);
    }
}
