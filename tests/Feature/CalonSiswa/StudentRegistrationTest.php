<?php

namespace Tests\Feature\CalonSiswa;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StudentRegistrationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Fitur: Pendaftaran Tahap 1 (Biodata) - Akses Form
     * Route: GET /pendaftaran/step1
     */
    public function test_student_can_access_step_1_biodata_form()
    {
        $this->markTestIncomplete('Test belum diimplementasikan.');
    }

    /**
     * Fitur: Pendaftaran Tahap 1 (Biodata) - Simpan Data
     * Route: POST /pendaftaran/step1
     */
    public function test_student_can_store_step_1_biodata()
    {
        $this->markTestIncomplete('Test belum diimplementasikan.');
    }

    /**
     * Fitur: Logic Pencegahan Akses
     * Tujuan: Memastikan siswa tidak bisa loncat ke step 2 tanpa menyelesaikan step 1
     */
    public function test_student_cannot_access_step_2_without_completing_step_1()
    {
        $this->markTestIncomplete('Test belum diimplementasikan.');
    }

    /**
     * Fitur: Pendaftaran Tahap 2 (Orang Tua) - Simpan Data
     * Route: POST /pendaftaran/step2
     */
    public function test_student_can_store_step_2_parent_data()
    {
        $this->markTestIncomplete('Test belum diimplementasikan.');
    }

    /**
     * Fitur: Pendaftaran Tahap 3 (Upload) - Upload Berkas
     * Route: POST /pendaftaran/upload
     */
    public function test_student_can_upload_documents()
    {
        $this->markTestIncomplete('Test belum diimplementasikan.');
    }

    /**
     * Fitur: Validasi Upload
     * Tujuan: Mencegah upload file yang tidak sesuai format/ukuran
     */
    public function test_student_cannot_upload_invalid_file_type()
    {
        $this->markTestIncomplete('Test belum diimplementasikan.');
    }

    /**
     * Fitur: Finalisasi Pendaftaran
     * Route: POST /pendaftaran/submit
     */
    public function test_student_can_submit_registration()
    {
        $this->markTestIncomplete('Test belum diimplementasikan.');
    }

    /**
     * Fitur: Validasi Finalisasi
     * Tujuan: Tidak bisa submit jika berkas wajib belum ada
     */
    public function test_student_cannot_submit_without_required_documents()
    {
        $this->markTestIncomplete('Test belum diimplementasikan.');
    }

    /**
     * Fitur: Logic Gelombang
     * Tujuan: Tidak bisa daftar jika tidak ada gelombang aktif
     */
    public function test_registration_blocked_when_no_active_gelombang()
    {
        $this->markTestIncomplete('Test belum diimplementasikan.');
    }
}
