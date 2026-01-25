<?php

namespace Tests\Unit\Models;

use App\Models\Gelombang;
use App\Models\Jurusan;
use App\Models\Pendaftaran;
use App\Models\Periode;
use App\Models\User;
use App\Models\OrangTuaSiswa;
use App\Models\Berkas;
use App\Models\JenisBerkas;
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
        $this->assertInstanceOf(Pendaftaran::class, $pendaftaran);
    }

    public function test_pendaftaran_has_user_relation()
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
            'no_pendaftaran' => 'REG456', 'nisn' => '0987654321', 'nama_lengkap' => 'Test Student',
            'jenis_kelamin' => 'P', 'tempat_lahir' => 'Jakarta', 'tanggal_lahir' => '2006-05-15',
            'agama' => 'Kristen', 'alamat_rumah' => 'Jl. Test', 'nomor_hp' => '081234',
            'asal_sekolah' => 'SMP 2', 'user_id' => $user->id, 'gelombang_id' => $gelombang->id,
            'jurusan_id' => $jurusan->id, 'status' => 'draft', 'current_step' => 1
        ]);

        $this->assertInstanceOf(User::class, $pendaftaran->user);
        $this->assertEquals($user->id, $pendaftaran->user->id);
    }

    public function test_pendaftaran_has_gelombang_and_jurusan_relations()
    {
        $user = User::factory()->create();
        $periode = Periode::create([
             'nama_periode' => 'P', 'tahun_ajaran' => '2025/2026', 
             'tanggal_mulai' => '2025-01-01', 'tanggal_selesai' => '2025-12-31', 'is_active' => 1
        ]);
        $gelombang = Gelombang::create([
            'nama' => 'Gelombang Test', 'periode_id' => $periode->id, 'tahun_ajaran' => '2025/2026',
            'tanggal_mulai' => '2025-01-01', 'tanggal_selesai' => '2025-02-01', 'kuota' => 100, 'is_active' => 1
        ]);
        $jurusan = Jurusan::create(['kode' => 'RPL', 'nama' => 'Rekayasa Perangkat Lunak', 'kuota' => 10, 'status' => 'aktif']);

        $pendaftaran = Pendaftaran::create([
            'no_pendaftaran' => 'REG789', 'nisn' => '1111111111', 'nama_lengkap' => 'Another',
            'jenis_kelamin' => 'L', 'tempat_lahir' => 'Bandung', 'tanggal_lahir' => '2005-12-01',
            'agama' => 'Islam', 'alamat_rumah' => 'Jl. ABC', 'nomor_hp' => '08999',
            'asal_sekolah' => 'SMP 3', 'user_id' => $user->id, 'gelombang_id' => $gelombang->id,
            'jurusan_id' => $jurusan->id, 'status' => 'draft', 'current_step' => 1
        ]);

        $this->assertInstanceOf(Gelombang::class, $pendaftaran->gelombang);
        $this->assertEquals('Gelombang Test', $pendaftaran->gelombang->nama);
        $this->assertInstanceOf(Jurusan::class, $pendaftaran->jurusan);
        $this->assertEquals('Rekayasa Perangkat Lunak', $pendaftaran->jurusan->nama);
    }

    public function test_pendaftaran_has_orang_tua_relation()
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
            'no_pendaftaran' => 'REGORANGTU', 'nisn' => '3333333', 'nama_lengkap' => 'With Parent',
            'jenis_kelamin' => 'L', 'tempat_lahir' => 'City', 'tanggal_lahir' => '2005-01-01',
            'agama' => 'Islam', 'alamat_rumah' => 'Addrs', 'nomor_hp' => '081',
            'asal_sekolah' => 'SMP', 'user_id' => $user->id, 'gelombang_id' => $gelombang->id,
            'jurusan_id' => $jurusan->id, 'status' => 'draft', 'current_step' => 1
        ]);

        $orangTua = OrangTuaSiswa::create([
            'pendaftaran_id' => $pendaftaran->id,
            'nama_ayah' => 'Dad', 'pekerjaan_ayah' => 'Engineer', 'penghasilan_ayah' => 5000000,
            'nama_ibu' => 'Mom', 'pekerjaan_ibu' => 'Teacher', 'penghasilan_ibu' => 4000000,
            'no_hp_orangtua' => '08555'
        ]);

        $pendaftaran = $pendaftaran->fresh();
        $this->assertInstanceOf(OrangTuaSiswa::class, $pendaftaran->orangTua);
        $this->assertEquals('Dad', $pendaftaran->orangTua->nama_ayah);
    }

    public function test_scope_aktif_returns_active_gelombang_only()
    {
        $user = User::factory()->create();
        $periode = Periode::create([
             'nama_periode' => 'P', 'tahun_ajaran' => '2025/2026', 
             'tanggal_mulai' => '2025-01-01', 'tanggal_selesai' => '2025-12-31', 'is_active' => 1
        ]);
        
        $activeGelombang = Gelombang::create([
            'nama' => 'Active', 'periode_id' => $periode->id, 'tahun_ajaran' => '2025/2026',
            'tanggal_mulai' => '2025-01-01', 'tanggal_selesai' => '2025-02-01', 'kuota' => 100, 'is_active' => true
        ]);

        $inactiveGelombang = Gelombang::create([
            'nama' => 'Inactive', 'periode_id' => $periode->id, 'tahun_ajaran' => '2025/2026',
            'tanggal_mulai' => '2025-01-01', 'tanggal_selesai' => '2025-02-01', 'kuota' => 100, 'is_active' => false
        ]);

        $jurusan = Jurusan::create(['kode' => 'T', 'nama' => 'T', 'kuota' => 10, 'status' => 'aktif']);

        Pendaftaran::create([
            'no_pendaftaran' => 'ACT', 'nisn' => '5555', 'nama_lengkap' => 'Active Student',
            'jenis_kelamin' => 'L', 'tempat_lahir' => 'City', 'tanggal_lahir' => '2005-01-01',
            'agama' => 'Islam', 'alamat_rumah' => 'Addr', 'nomor_hp' => '081',
            'asal_sekolah' => 'SMP', 'user_id' => $user->id, 'gelombang_id' => $activeGelombang->id,
            'jurusan_id' => $jurusan->id, 'status' => 'draft', 'current_step' => 1
        ]);

        Pendaftaran::create([
            'no_pendaftaran' => 'INACT', 'nisn' => '6666', 'nama_lengkap' => 'Inactive Student',
            'jenis_kelamin' => 'P', 'tempat_lahir' => 'City', 'tanggal_lahir' => '2005-01-01',
            'agama' => 'Islam', 'alamat_rumah' => 'Addr', 'nomor_hp' => '081',
            'asal_sekolah' => 'SMP', 'user_id' => $user->id, 'gelombang_id' => $inactiveGelombang->id,
            'jurusan_id' => $jurusan->id, 'status' => 'draft', 'current_step' => 1
        ]);

        $aktifPendaftarans = Pendaftaran::aktif()->get();
        
        $this->assertCount(1, $aktifPendaftarans);
        $this->assertEquals('ACT', $aktifPendaftarans->first()->no_pendaftaran);
    }

    public function test_tanggal_lahir_formatted_accessor()
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
            'no_pendaftaran' => 'REGDATE', 'nisn' => '7777', 'nama_lengkap' => 'Date Test',
            'jenis_kelamin' => 'L', 'tempat_lahir' => 'City', 'tanggal_lahir' => '2005-06-15',
            'agama' => 'Islam', 'alamat_rumah' => 'Addr', 'nomor_hp' => '081',
            'asal_sekolah' => 'SMP', 'user_id' => $user->id, 'gelombang_id' => $gelombang->id,
            'jurusan_id' => $jurusan->id, 'status' => 'draft', 'current_step' => 1
        ]);

        $formatted = $pendaftaran->tanggal_lahir_formatted;
        $this->assertStringContainsString('15', $formatted);
        $this->assertStringContainsString('2005', $formatted);
    }
}
