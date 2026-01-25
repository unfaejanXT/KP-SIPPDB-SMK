<?php

namespace Tests\Unit\Exports;

use App\Exports\RekapPPDBExport;
use App\Models\Pendaftaran;
use App\Models\User;
use App\Models\Periode;
use App\Models\Gelombang;
use App\Models\Jurusan;
use App\Models\OrangTuaSiswa;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RekapPPDBExportTest extends TestCase
{
    use RefreshDatabase;

    public function test_export_returns_view()
    {
        $export = new RekapPPDBExport();
        $view = $export->view();

        $this->assertInstanceOf(\Illuminate\Contracts\View\View::class, $view);
        $this->assertEquals('admin.laporan.export_excel', $view->name());
    }

    public function test_export_can_filter_by_jurusan()
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

        $jurusan1 = Jurusan::create(['kode' => 'RPL', 'nama' => 'RPL', 'kuota' => 10, 'status' => 'aktif']);
        $jurusan2 = Jurusan::create(['kode' => 'TKJ', 'nama' => 'TKJ', 'kuota' => 10, 'status' => 'aktif']);

        Pendaftaran::create([
            'no_pendaftaran' => 'REG1', 'nisn' => '111', 'nama_lengkap' => 'Student 1',
            'jenis_kelamin' => 'L', 'tempat_lahir' => 'C', 'tanggal_lahir' => '2005-01-01',
            'agama' => 'Islam', 'alamat_rumah' => 'A', 'nomor_hp' => '081',
            'asal_sekolah' => 'SMP', 'user_id' => $user->id, 'gelombang_id' => $gelombang->id,
            'jurusan_id' => $jurusan1->id, 'status' => 'draft', 'current_step' => 1
        ]);

        Pendaftaran::create([
            'no_pendaftaran' => 'REG2', 'nisn' => '222', 'nama_lengkap' => 'Student 2',
            'jenis_kelamin' => 'P', 'tempat_lahir' => 'C', 'tanggal_lahir' => '2005-01-01',
            'agama' => 'Islam', 'alamat_rumah' => 'A', 'nomor_hp' => '081',
            'asal_sekolah' => 'SMP', 'user_id' => $user->id, 'gelombang_id' => $gelombang->id,
            'jurusan_id' => $jurusan2->id, 'status' => 'draft', 'current_step' => 1
        ]);

        $export = new RekapPPDBExport(['jurusan_id' => $jurusan1->id]);
        $view = $export->view();
        $data = $view->getData();

        $this->assertCount(1, $data['pendaftaranData']);
        $this->assertEquals('REG1', $data['pendaftaranData'][0]->no_pendaftaran);
    }

    public function test_export_can_filter_by_gelombang()
    {
        $user = User::factory()->create();
        $periode = Periode::create([
            'nama_periode' => 'P', 'tahun_ajaran' => '2025/2026',
            'tanggal_mulai' => '2025-01-01', 'tanggal_selesai' => '2025-12-31', 'is_active' => 1
        ]);
        $gelombang1 = Gelombang::create([
            'nama' => 'G1', 'periode_id' => $periode->id, 'tahun_ajaran' => '2025/2026',
            'tanggal_mulai' => '2025-01-01', 'tanggal_selesai' => '2025-02-01', 'kuota' => 100, 'is_active' => 1
        ]);
        $gelombang2 = Gelombang::create([
            'nama' => 'G2', 'periode_id' => $periode->id, 'tahun_ajaran' => '2025/2026',
            'tanggal_mulai' => '2025-03-01', 'tanggal_selesai' => '2025-04-01', 'kuota' => 100, 'is_active' => 1
        ]);

        $jurusan = Jurusan::create(['kode' => 'RPL', 'nama' => 'RPL', 'kuota' => 10, 'status' => 'aktif']);

        Pendaftaran::create([
            'no_pendaftaran' => 'REG1', 'nisn' => '111', 'nama_lengkap' => 'Student 1',
            'jenis_kelamin' => 'L', 'tempat_lahir' => 'C', 'tanggal_lahir' => '2005-01-01',
            'agama' => 'Islam', 'alamat_rumah' => 'A', 'nomor_hp' => '081',
            'asal_sekolah' => 'SMP', 'user_id' => $user->id, 'gelombang_id' => $gelombang1->id,
            'jurusan_id' => $jurusan->id, 'status' => 'draft', 'current_step' => 1
        ]);

        Pendaftaran::create([
            'no_pendaftaran' => 'REG2', 'nisn' => '222', 'nama_lengkap' => 'Student 2',
            'jenis_kelamin' => 'P', 'tempat_lahir' => 'C', 'tanggal_lahir' => '2005-01-01',
            'agama' => 'Islam', 'alamat_rumah' => 'A', 'nomor_hp' => '081',
            'asal_sekolah' => 'SMP', 'user_id' => $user->id, 'gelombang_id' => $gelombang2->id,
            'jurusan_id' => $jurusan->id, 'status' => 'draft', 'current_step' => 1
        ]);

        $export = new RekapPPDBExport(['gelombang_id' => $gelombang2->id]);
        $view = $export->view();
        $data = $view->getData();

        $this->assertCount(1, $data['pendaftaranData']);
        $this->assertEquals('REG2', $data['pendaftaranData'][0]->no_pendaftaran);
    }

    public function test_export_can_filter_by_status()
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
        $jurusan = Jurusan::create(['kode' => 'RPL', 'nama' => 'RPL', 'kuota' => 10, 'status' => 'aktif']);

        Pendaftaran::create([
            'no_pendaftaran' => 'REG1', 'nisn' => '111', 'nama_lengkap' => 'Student 1',
            'jenis_kelamin' => 'L', 'tempat_lahir' => 'C', 'tanggal_lahir' => '2005-01-01',
            'agama' => 'Islam', 'alamat_rumah' => 'A', 'nomor_hp' => '081',
            'asal_sekolah' => 'SMP', 'user_id' => $user->id, 'gelombang_id' => $gelombang->id,
            'jurusan_id' => $jurusan->id, 'status' => 'draft', 'current_step' => 1
        ]);

        Pendaftaran::create([
            'no_pendaftaran' => 'REG2', 'nisn' => '222', 'nama_lengkap' => 'Student 2',
            'jenis_kelamin' => 'P', 'tempat_lahir' => 'C', 'tanggal_lahir' => '2005-01-01',
            'agama' => 'Islam', 'alamat_rumah' => 'A', 'nomor_hp' => '081',
            'asal_sekolah' => 'SMP', 'user_id' => $user->id, 'gelombang_id' => $gelombang->id,
            'jurusan_id' => $jurusan->id, 'status' => 'verified', 'current_step' => 3
        ]);

        $export = new RekapPPDBExport(['status' => 'verified']);
        $view = $export->view();
        $data = $view->getData();

        $this->assertCount(1, $data['pendaftaranData']);
        $this->assertEquals('verified', $data['pendaftaranData'][0]->status);
    }

    public function test_export_with_no_filters_returns_all_data()
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
        $jurusan = Jurusan::create(['kode' => 'RPL', 'nama' => 'RPL', 'kuota' => 10, 'status' => 'aktif']);

        Pendaftaran::create([
            'no_pendaftaran' => 'REG1', 'nisn' => '111', 'nama_lengkap' => 'Student 1',
            'jenis_kelamin' => 'L', 'tempat_lahir' => 'C', 'tanggal_lahir' => '2005-01-01',
            'agama' => 'Islam', 'alamat_rumah' => 'A', 'nomor_hp' => '081',
            'asal_sekolah' => 'SMP', 'user_id' => $user->id, 'gelombang_id' => $gelombang->id,
            'jurusan_id' => $jurusan->id, 'status' => 'draft', 'current_step' => 1
        ]);

        Pendaftaran::create([
            'no_pendaftaran' => 'REG2', 'nisn' => '222', 'nama_lengkap' => 'Student 2',
            'jenis_kelamin' => 'P', 'tempat_lahir' => 'C', 'tanggal_lahir' => '2005-01-01',
            'agama' => 'Islam', 'alamat_rumah' => 'A', 'nomor_hp' => '081',
            'asal_sekolah' => 'SMP', 'user_id' => $user->id, 'gelombang_id' => $gelombang->id,
            'jurusan_id' => $jurusan->id, 'status' => 'verified', 'current_step' => 3
        ]);

        $export = new RekapPPDBExport();
        $view = $export->view();
        $data = $view->getData();

        $this->assertCount(2, $data['pendaftaranData']);
    }
}
