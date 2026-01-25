<?php

namespace Tests\Unit\Models;

use App\Models\Gelombang;
use App\Models\Jurusan;
use App\Models\Pendaftaran;
use App\Models\Periode;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PendaftaranTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_pendaftaran()
    {
        $user = User::factory()->create();
        $periode = Periode::create([
             'nama_periode' => 'P', 'tahun_ajaran' => '2025/2026', 
             'tanggal_mulai' => '2025-01-01', 'tanggal_selesai' => '2025-12-31', 'is_active' => 1
        ]);
        $gelombang = Gelombang::create([
            'nama' => 'G1', 'periode_id' => $periode->id, 'tahun_ajaran' => '2025/2026',
            'tanggal_mulai' => '2025-01-01', 'tanggal_selesai' => '2025-02-01', 'kuota' => 100, 'is_active' => 1
        ]);
        // Jurusan might be seeded, but let's create one to be sure
        $jurusan = Jurusan::create(['kode' => 'TEST', 'nama' => 'Test Jurusan', 'kuota' => 10, 'status' => 'aktif']);

        $pendaftaran = Pendaftaran::create([
            'no_pendaftaran' => 'REG123',
            'nisn' => '1234567890',
            'nama_lengkap' => 'Student Name',
            'jenis_kelamin' => 'L',
            'tempat_lahir' => 'City',
            'tanggal_lahir' => '2005-01-01',
            'agama' => 'Islam',
            'alamat_rumah' => 'Address',
            'nomor_hp' => '08123456789',
            'asal_sekolah' => 'SMP 1',
            'user_id' => $user->id,
            'gelombang_id' => $gelombang->id,
            'jurusan_id' => $jurusan->id,
            'status' => 'draft',
            'current_step' => 1
        ]);

        $this->assertDatabaseHas('pendaftaran', ['no_pendaftaran' => 'REG123']);
        $this->assertEquals(now()->diffInYears('2005-01-01'), $pendaftaran->usia);
    }
}
