<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminVerificationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Fitur: Verifikasi Berkas - List
     * Route: /admin/verifikasi-berkas
     */
    public function test_admin_can_view_pending_document_verifications()
    {
        $this->markTestIncomplete('Test belum diimplementasikan.');
    }

    /**
     * Fitur: Verifikasi Berkas - Detail
     * Route: /admin/verifikasi-berkas/{id}
     */
    public function test_admin_can_view_student_document_details()
    {
        $this->markTestIncomplete('Test belum diimplementasikan.');
    }

    /**
     * Fitur: Approve Berkas
     * Route: POST /admin/verifikasi-berkas/{berkas}/status
     */
    public function test_admin_can_approve_document()
    {
        $this->markTestIncomplete('Test belum diimplementasikan.');
    }

    /**
     * Fitur: Reject Berkas
     * Route: POST /admin/verifikasi-berkas/{berkas}/status
     */
    public function test_admin_can_reject_document_with_notes()
    {
        $this->markTestIncomplete('Test belum diimplementasikan.');
    }

    /**
     * Fitur: Logic Update Status Pendaftaran
     * Tujuan: Status pendaftaran berubah jadi 'terverifikasi' jika semua berkas valid
     */
    public function test_registration_status_becomes_verified_when_all_docs_approved()
    {
        $this->markTestIncomplete('Test belum diimplementasikan.');
    }

    /**
     * Fitur: Logic Penolakan
     * Tujuan: Status pendaftaran berubah jadi 'ditolak'/'perbaikan' jika ada berkas ditolak
     */
    public function test_registration_status_becomes_rejected_if_any_doc_rejected()
    {
        $this->markTestIncomplete('Test belum diimplementasikan.');
    }
}
