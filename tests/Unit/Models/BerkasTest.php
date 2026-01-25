<?php

namespace Tests\Unit\Models;

use App\Models\Berkas;
use App\Models\JenisBerkas;
use App\Models\Pendaftaran;
use App\Models\User;
use App\Models\Periode;
use App\Models\Gelombang;
use App\Models\Jurusan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BerkasTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_berkas()
    {
        // Create dependencies
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
            'no_pendaftaran' => 'REG1', 'nisn' => '111', 'nama_lengkap' => 'S',
            'jenis_kelamin' => 'L', 'tempat_lahir' => 'C', 'tanggal_lahir' => '2005-01-01',
            'agama' => 'Islam', 'alamat_rumah' => 'A', 'nomor_hp' => '081',
            'asal_sekolah' => 'SMP', 'user_id' => $user->id, 'gelombang_id' => $gelombang->id,
            'jurusan_id' => $jurusan->id, 'status' => 'draft', 'current_step' => 1
        ]);
        
        $jenis = JenisBerkas::create(['kode_berkas' => 'K', 'nama_berkas' => 'K', 'is_wajib' => 1, 'is_active' => 1]);
        
        $berkas = Berkas::create([
            'pendaftaran_id' => $pendaftaran->id,
            'jenis_berkas_id' => $jenis->id,
            'file_path' => 'path/to/file.pdf',
            'status_verifikasi' => 'pending',
            'uploaded_at' => now(),
        ]);

        $this->assertDatabaseHas('berkas', ['file_path' => 'path/to/file.pdf']);
        $this->assertEquals($pendaftaran->id, $berkas->pendaftaran_id);
    }

    public function test_verifikasi_method()
    {
        // Create dependencies
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
            'no_pendaftaran' => 'REG2', 'nisn' => '222', 'nama_lengkap' => 'S',
            'jenis_kelamin' => 'L', 'tempat_lahir' => 'C', 'tanggal_lahir' => '2005-01-01',
            'agama' => 'Islam', 'alamat_rumah' => 'A', 'nomor_hp' => '081',
            'asal_sekolah' => 'SMP', 'user_id' => $user->id, 'gelombang_id' => $gelombang->id,
            'jurusan_id' => $jurusan->id, 'status' => 'draft', 'current_step' => 1
        ]);
        $jenis = JenisBerkas::create(['kode_berkas' => 'KK', 'nama_berkas' => 'KK', 'is_wajib' => 1, 'is_active' => 1]);

        $berkas = Berkas::create([
            'pendaftaran_id' => $pendaftaran->id,
            'jenis_berkas_id' => $jenis->id,
            'file_path' => 'test.pdf',
            'status_verifikasi' => 'pending',
            'uploaded_at' => now(),
        ]);

        $berkas->verifikasi('verified', 'Oke');

        $berkas->refresh();
        $this->assertEquals('verified', $berkas->status_verifikasi);
        $this->assertEquals('Oke', $berkas->catatan_verifikasi);
        $this->assertNotNull($berkas->verified_at);
        $this->assertTrue($berkas->isTerverifikasi());
    }

    public function test_berkas_has_pendaftaran_relation()
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
        $jurusan = Jurusan::create(['kode' => 'T', 'nama' => 'T', 'kuota' => 10, 'status' => 'aktif']);
        $pendaftaran = Pendaftaran::create([
            'no_pendaftaran' => 'REG3', 'nisn' => '333', 'nama_lengkap' => 'S',
            'jenis_kelamin' => 'L', 'tempat_lahir' => 'C', 'tanggal_lahir' => '2005-01-01',
            'agama' => 'Islam', 'alamat_rumah' => 'A', 'nomor_hp' => '081',
            'asal_sekolah' => 'SMP', 'user_id' => $user->id, 'gelombang_id' => $gelombang->id,
            'jurusan_id' => $jurusan->id, 'status' => 'draft', 'current_step' => 1
        ]);
        $jenis = JenisBerkas::create(['kode_berkas' => 'KB', 'nama_berkas' => 'KB', 'is_wajib' => 1, 'is_active' => 1]);

        $berkas = Berkas::create([
            'pendaftaran_id' => $pendaftaran->id,
            'jenis_berkas_id' => $jenis->id,
            'file_path' => 'file.pdf',
            'status_verifikasi' => 'pending',
            'uploaded_at' => now(),
        ]);

        $this->assertInstanceOf(Pendaftaran::class, $berkas->pendaftaran);
        $this->assertEquals($pendaftaran->id, $berkas->pendaftaran->id);
    }

    public function test_scope_terverifikasi()
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
        $jurusan = Jurusan::create(['kode' => 'T', 'nama' => 'T', 'kuota' => 10, 'status' => 'aktif']);
        $pendaftaran = Pendaftaran::create([
            'no_pendaftaran' => 'REG4', 'nisn' => '444', 'nama_lengkap' => 'S',
            'jenis_kelamin' => 'L', 'tempat_lahir' => 'C', 'tanggal_lahir' => '2005-01-01',
            'agama' => 'Islam', 'alamat_rumah' => 'A', 'nomor_hp' => '081',
            'asal_sekolah' => 'SMP', 'user_id' => $user->id, 'gelombang_id' => $gelombang->id,
            'jurusan_id' => $jurusan->id, 'status' => 'draft', 'current_step' => 1
        ]);
        $jenis = JenisBerkas::create(['kode_berkas' => 'KKB', 'nama_berkas' => 'KKB', 'is_wajib' => 1, 'is_active' => 1]);

        Berkas::create([
            'pendaftaran_id' => $pendaftaran->id,
            'jenis_berkas_id' => $jenis->id,
            'file_path' => 'verified.pdf',
            'status_verifikasi' => 'verified',
            'uploaded_at' => now(),
            'verified_at' => now(),
        ]);

        Berkas::create([
            'pendaftaran_id' => $pendaftaran->id,
            'jenis_berkas_id' => $jenis->id,
            'file_path' => 'pending.pdf',
            'status_verifikasi' => 'pending',
            'uploaded_at' => now(),
        ]);

        $terverifikasi = Berkas::terverifikasi()->get();
        
        $this->assertCount(1, $terverifikasi);
        $this->assertEquals('verified.pdf', $terverifikasi->first()->file_path);
    }
}
