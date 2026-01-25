<?php

namespace Tests\Unit\Models;

use App\Models\Berkas;
use App\Models\JenisBerkas;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BerkasTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_berkas()
    {
        $jenis = JenisBerkas::create(['kode_berkas' => 'K', 'nama_berkas' => 'K', 'is_wajib' => 1, 'is_active' => 1]);
        
        $berkas = Berkas::create([
            'pendaftaran_id' => 1, // Mock ID
            'jenis_berkas_id' => $jenis->id,
            'file_path' => 'path/to/file.pdf',
            'status_verifikasi' => 'pending',
            'uploaded_at' => now(),
        ]);

        $this->assertDatabaseHas('berkas', ['file_path' => 'path/to/file.pdf']);
    }

    public function test_verifikasi_method()
    {
        $berkas = new Berkas();
        $berkas->status_verifikasi = 'pending';
        $berkas->save();

        $berkas->verifikasi('verified', 'Oke');

        $this->assertEquals('verified', $berkas->status_verifikasi);
        $this->assertEquals('Oke', $berkas->catatan_verifikasi);
        $this->assertNotNull($berkas->verified_at);
        $this->assertTrue($berkas->isTerverifikasi());
    }
}
