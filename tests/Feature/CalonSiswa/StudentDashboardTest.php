<?php

namespace Tests\Feature\CalonSiswa;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


use App\Models\User;

class StudentDashboardTest extends TestCase
{
    use RefreshDatabase;

    protected $student;
    protected $pendaftaran;

    protected function setUp(): void
    {
        parent::setUp(); 

        // Create student user
        $this->student = User::factory()->create();
        $this->student->assignRole('user');

        // Get Gelombang and Jurusan seeded by parent::setUp
        $gelombang = \App\Models\Gelombang::where('is_active', true)->first();
        $jurusan = \App\Models\Jurusan::first();

        // Create mock pendaftaran attached to student
        // Using create directly since no factory
        $this->pendaftaran = \App\Models\Pendaftaran::create([
            'user_id' => $this->student->id,
            'gelombang_id' => $gelombang->id,
            'jurusan_id' => $jurusan->id,
            'no_pendaftaran' => 'PPDB-' . date('Y') . '-0001',
            'nisn' => '1234567890',
            'nama_lengkap' => $this->student->name,
            'jenis_kelamin' => 'L',
            'tempat_lahir' => 'Jakarta',
            'tanggal_lahir' => '2008-01-01',
            'agama' => 'Islam',
            'alamat_rumah' => 'Jl. Contoh No. 123',
            'nomor_hp' => '08123456789',
            'asal_sekolah' => 'SMP Negeri 1',
            'status' => 'draft', 
            'current_step' => 4 // Assuming completed steps for dashboard view
        ]);
    }

    /**
     * Fitur: Dashboard Siswa
     * Route: /dashboard
     */
    public function test_student_can_access_dashboard()
    {
        // Ensure status allows dashboard access (not draft)
        $this->pendaftaran->update(['status' => 'submitted']);

        $response = $this->actingAs($this->student)->get(route('dashboard'));
        
        $response->assertStatus(200);
        $response->assertSee($this->student->name);
    }

    /**
     * Fitur: Edit Pendaftaran
     * Route: /dashboard/edit
     */
    public function test_student_can_edit_biodata_before_final_verification()
    {
        // Set status to something editable (e.g. draft/revisi)
        $this->pendaftaran->update(['status' => 'draft']);

        $response = $this->actingAs($this->student)->get(route('pendaftaran.edit'));
        
        $response->assertStatus(200);
    }

    /**
     * Fitur: Pembatasan Edit
     * Tujuan: Data tidak bisa diedit jika status sudah final/terverifikasi
     */
    public function test_student_cannot_edit_data_after_verification()
    {
        // Set status to locked
        $this->pendaftaran->update(['status' => 'terverifikasi']);

        $response = $this->actingAs($this->student)->get(route('pendaftaran.edit'));
        
        // Expect redirect back or forbidden
        // Usually redirects to dashboard with error
        $response->assertRedirect(route('dashboard'));
        $response->assertSessionHas('error'); 
    }

    /**
     * Fitur: Cetak Bukti
     * Route: /dashboard/cetak-bukti
     */
    public function test_student_can_print_registration_proof()
    {
        // Only verify if status allows printing (usually accepted/verified)
        $this->pendaftaran->update(['status' => 'terverifikasi']);

        $response = $this->actingAs($this->student)->get(route('dashboard.cetak'));
        
        $response->assertStatus(200);
    }
}
