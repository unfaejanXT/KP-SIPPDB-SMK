<?php

namespace Tests\Unit\Models;

use App\Models\OrangTuaSiswa;
use App\Models\Pendaftaran;
use App\Models\User;
use App\Models\Gelombang;
use App\Models\Periode;
use App\Models\Jurusan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrangTuaSiswaTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_orangtua_siswa()
    {
        // Setup dependencies
        $user = User::factory()->create();
        $periode = Periode::create([
             'nama_periode' => 'P', 'tahun_ajaran' => '2025/2026', 
             'tanggal_mulai' => '2025-01-01', 'tanggal_selesai' => '2025-12-31', 'is_active' => 1
        ]);
        $gelombang = Gelombang::create([
            'nama' => 'G1', 'periode_id' => $periode->id, 'tahun_ajaran' => '2025/2026',
            'tanggal_mulai' => '2025-01-01', 'tanggal_selesai' => '2025-02-01', 'kuota' => 100, 'is_active' => 1
        ]);
        $jurusan = Jurusan::create(['kode' => 'T', 'nama' => 'T', 'kuota' => 10, 'status' => 'aktif']);

        $pendaftaran = Pendaftaran::create([
            'no_pendaftaran' => 'REG', 'nisn' => '123', 'nama_lengkap' => 'S', 'jenis_kelamin' => 'L',
            'tempat_lahir' => 'C', 'tanggal_lahir' => '2005-01-01', 'agama' => 'I',
            'alamat_rumah' => 'A', 'nomor_hp' => '081', 'asal_sekolah' => 'SMP',
            'user_id' => $user->id, 'gelombang_id' => $gelombang->id, 'jurusan_id' => $jurusan->id,
            'status' => 'draft', 'current_step' => 1
        ]);

        $orangTua = OrangTuaSiswa::create([
            'pendaftaran_id' => $pendaftaran->id,
            'nama_ayah' => 'Father',
            'pekerjaan_ayah' => 'Work',
            'penghasilan_ayah' => 1000000,
            'nama_ibu' => 'Mother',
            'pekerjaan_ibu' => 'Work',
            'penghasilan_ibu' => 1000000,
            'no_hp_orangtua' => '08123'
        ]);

        $this->assertDatabaseHas('orangtuasiswa', ['nama_ayah' => 'Father']);
        $this->assertEquals('Father & Mother', $orangTua->nama_orangtua_formatted);
    }
}
