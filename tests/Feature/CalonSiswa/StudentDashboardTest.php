<?php

namespace Tests\Feature\CalonSiswa;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StudentDashboardTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Fitur: Dashboard Siswa
     * Route: /dashboard
     */
    public function test_student_can_access_dashboard()
    {
        $this->markTestIncomplete('Test belum diimplementasikan.');
    }

    /**
     * Fitur: Edit Pendaftaran
     * Route: /dashboard/edit
     */
    public function test_student_can_edit_biodata_before_final_verification()
    {
        $this->markTestIncomplete('Test belum diimplementasikan.');
    }

    /**
     * Fitur: Pembatasan Edit
     * Tujuan: Data tidak bisa diedit jika status sudah final/terverifikasi
     */
    public function test_student_cannot_edit_data_after_verification()
    {
        $this->markTestIncomplete('Test belum diimplementasikan.');
    }

    /**
     * Fitur: Cetak Bukti
     * Route: /dashboard/cetak-bukti
     */
    public function test_student_can_print_registration_proof()
    {
        $this->markTestIncomplete('Test belum diimplementasikan.');
    }
}
