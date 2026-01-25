<?php

namespace Tests\Feature\CalonSiswa;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


use App\Models\User;
use App\Models\Gelombang;
use App\Models\Jurusan;
use App\Models\Pendaftaran;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;



class StudentRegistrationTest extends TestCase
{
    use RefreshDatabase;

    protected $student;
    protected $gelombang;
    protected $jurusan;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->student = User::factory()->create();
        $this->student->assignRole('user');
        
        $this->gelombang = Gelombang::where('is_active', true)->first();
        $this->jurusan = Jurusan::first();
    }

    /**
     * Fitur: Pendaftaran Tahap 1 (Biodata) - Akses Form
     * Route: GET /pendaftaran/step1
     */
    public function test_student_can_access_step_1_biodata_form()
    {
        $response = $this->actingAs($this->student)->get(route('pendaftaran.step1'));
        $response->assertStatus(200);
    }

    /**
     * Fitur: Pendaftaran Tahap 1 (Biodata) - Simpan Data
     * Route: POST /pendaftaran/step1
     */
    public function test_student_can_store_step_1_biodata()
    {
        $response = $this->actingAs($this->student)->post(route('pendaftaran.storeStep1'), [
            'nisn' => '1234567899',
            'nama_lengkap' => 'Test Siswa',
            'jenis_kelamin' => 'L',
            'tempat_lahir' => 'Bandung',
            'tanggal_lahir' => '2008-01-01',
            'agama' => 'Islam',
            'nomor_hp' => '081234567890',
            'alamat_rumah' => 'Jalan Test',
            'asal_sekolah' => 'SMP Test',
            'jurusan_id' => $this->jurusan->id,
            // Assuming gelombang_id is handled by controller or hidden input
            'gelombang_id' => $this->gelombang->id 
        ]);

        $response->assertRedirect(route('pendaftaran.step2'));
        $this->assertDatabaseHas('pendaftaran', [
            'user_id' => $this->student->id,
            'nisn' => '1234567899'
        ]);
    }

    /**
     * Fitur: Logic Pencegahan Akses
     * Tujuan: Memastikan siswa tidak bisa loncat ke step 2 tanpa menyelesaikan step 1
     */
    public function test_student_cannot_access_step_2_without_completing_step_1()
    {
        $response = $this->actingAs($this->student)->get(route('pendaftaran.step2'));
        $response->assertRedirect(route('pendaftaran.step1'));
    }

    /**
     * Fitur: Pendaftaran Tahap 2 (Orang Tua) - Simpan Data
     * Route: POST /pendaftaran/step2
     */
    public function test_student_can_store_step_2_parent_data()
    {
        // Setup Step 1 first
        $pendaftaran = Pendaftaran::create([
            'user_id' => $this->student->id,
            'gelombang_id' => $this->gelombang->id,
            'jurusan_id' => $this->jurusan->id,
            'no_pendaftaran' => 'TEST001',
            'nisn' => '1234567899',
            'nama_lengkap' => 'Test Siswa',
            'jenis_kelamin' => 'L',
            'tempat_lahir' => 'Bandung',
            'tanggal_lahir' => '2008-01-01',
            'agama' => 'Islam',
            'nomor_hp' => '081234567890',
            'alamat_rumah' => 'Jalan Test',
            'asal_sekolah' => 'SMP Test',
            'status' => 'draft',
            'current_step' => 2
        ]);

        $response = $this->actingAs($this->student)->post(route('pendaftaran.storeStep2'), [
            'nama_ayah' => 'Ayah Test',
            'pekerjaan_ayah' => 'Wiraswasta',
            'penghasilan_ayah' => 5000000,
            'no_hp_orangtua' => '08111111111',
            'nama_ibu' => 'Ibu Test',
            'pekerjaan_ibu' => 'IRT',
            'penghasilan_ibu' => 0,
        ]);

        $response->assertRedirect(route('pendaftaran.step3'));
        $this->assertDatabaseHas('orangtuasiswa', [
            'pendaftaran_id' => $pendaftaran->id,
            'nama_ayah' => 'Ayah Test'
        ]);
    }

    /**
     * Fitur: Pendaftaran Tahap 3 (Upload) - Upload Berkas
     * Route: POST /pendaftaran/upload
     */
    public function test_student_can_upload_documents()
    {
        Storage::fake('public');
        
        // Setup Step 2 completed (Current step 3)
        $pendaftaran = Pendaftaran::create([
            'user_id' => $this->student->id,
            'gelombang_id' => $this->gelombang->id,
            'jurusan_id' => $this->jurusan->id,
            'no_pendaftaran' => 'TEST001',
            'nisn' => '1234567899',
            'nama_lengkap' => 'Test Siswa',
            'jenis_kelamin' => 'L',
            'tempat_lahir' => 'Bandung',
            'tanggal_lahir' => '2008-01-01',
            'agama' => 'Islam',
            'alamat_rumah' => 'Jalan Test',
            'nomor_hp' => '081234567890',
            'asal_sekolah' => 'SMP Test',
            'status' => 'draft',
            'current_step' => 3
        ]);

        // Create Jenis Berkas
        $jenis = \App\Models\JenisBerkas::create([
            'kode_berkas' => 'IJAZAH',
            'nama_berkas' => 'Ijazah',
            'is_wajib' => true,
            'is_active' => true
        ]);

        $file = UploadedFile::fake()->create('document.pdf', 100);

        $response = $this->actingAs($this->student)->post(route('pendaftaran.upload'), [
            'kode_berkas' => $jenis->kode_berkas,
            'file' => $file
        ]);

        $response->assertStatus(200); 
    }

    /**
     * Fitur: Validasi Upload
     * Tujuan: Mencegah upload file yang tidak sesuai format/ukuran
     */
    public function test_student_cannot_upload_invalid_file_type()
    {
        Storage::fake('public');
        
        $pendaftaran = Pendaftaran::create([
            'user_id' => $this->student->id,
            'gelombang_id' => $this->gelombang->id,
            'jurusan_id' => $this->jurusan->id,
            'no_pendaftaran' => 'TEST001',
            'nisn' => '1234567899',
            'nama_lengkap' => 'Test Siswa',
            'jenis_kelamin' => 'L',
            'tempat_lahir' => 'Bandung',
            'tanggal_lahir' => '2008-01-01',
            'agama' => 'Islam',
            'alamat_rumah' => 'Jalan Test',
            'nomor_hp' => '081234567890',
            'asal_sekolah' => 'SMP Test',
            'status' => 'draft',
            'current_step' => 3
        ]);

        $jenis = \App\Models\JenisBerkas::create([
            'kode_berkas' => 'IJAZAH',
            'nama_berkas' => 'Ijazah',
            'is_wajib' => true,
            'is_active' => true
        ]);

        // Assume pdf/jpg only
        $file = UploadedFile::fake()->create('virus.exe', 100);

        $response = $this->actingAs($this->student)->post(route('pendaftaran.upload'), [
            'kode_berkas' => $jenis->kode_berkas,
            'file' => $file
        ]);

        // Expect validation error
        $response->assertSessionHasErrors(['file']);
    }

    /**
     * Fitur: Finalisasi Pendaftaran
     * Route: POST /pendaftaran/submit
     */
    public function test_student_can_submit_registration()
    {
        // Setup fully ready pendaftaran
        $pendaftaran = Pendaftaran::create([
            'user_id' => $this->student->id,
            'gelombang_id' => $this->gelombang->id,
            'jurusan_id' => $this->jurusan->id,
            'no_pendaftaran' => 'TEST001',
            'nisn' => '1234567899',
            'nama_lengkap' => 'Test Siswa',
            'jenis_kelamin' => 'L',
            'tempat_lahir' => 'Bandung',
            'tanggal_lahir' => '2008-01-01',
            'agama' => 'Islam',
            'alamat_rumah' => 'Jalan Test',
            'nomor_hp' => '081234567890',
            'asal_sekolah' => 'SMP Test',
            'status' => 'draft',
            'current_step' => 4 
        ]);
        
        $jenis = \App\Models\JenisBerkas::create([
            'kode_berkas' => 'IJAZAH',
            'nama_berkas' => 'Ijazah',
            'is_wajib' => true,
            'is_active' => true
        ]);

        \App\Models\Berkas::create([
            'pendaftaran_id' => $pendaftaran->id,
            'jenis_berkas_id' => $jenis->id,
            'nama_original' => 'test.pdf', // Using nama_original instead of nama_file if that matches migration?
            // Migration for Berkas?
            'file_path' => 'uploads/test.pdf',
            'status_verifikasi' => 'pending', // Usually defaults
        ]);

        $response = $this->actingAs($this->student)->post(route('pendaftaran.submit'));
        
        $response->assertRedirect(route('dashboard')); // Controller redirects to dashboard not success
        $this->assertDatabaseHas('pendaftaran', [
            'id' => $pendaftaran->id,
            'status' => 'submitted' 
        ]);
    }

    /**
     * Fitur: Validasi Finalisasi
     * Tujuan: Tidak bisa submit jika berkas wajib belum ada
     */
    public function test_student_cannot_submit_without_required_documents()
    {
        $pendaftaran = Pendaftaran::create([
            'user_id' => $this->student->id,
            'gelombang_id' => $this->gelombang->id,
            'jurusan_id' => $this->jurusan->id,
            'no_pendaftaran' => 'TEST001',
            'nisn' => '1234567899',
            'nama_lengkap' => 'Test Siswa',
            'jenis_kelamin' => 'L',
            'tempat_lahir' => 'Bandung',
            'tanggal_lahir' => '2008-01-01',
            'agama' => 'Islam',
            'alamat_rumah' => 'Jalan Test',
            'nomor_hp' => '081234567890',
            'asal_sekolah' => 'SMP Test',
            'status' => 'draft',
            'current_step' => 4
        ]);
        
        // Define required doc
        \App\Models\JenisBerkas::create([
            'kode_berkas' => 'JIB',
            'nama_berkas' => 'Wajib',
            'is_wajib' => true,
            'is_active' => true
        ]);

        $response = $this->actingAs($this->student)->post(route('pendaftaran.submit'));
        
        $response->assertRedirect(route('pendaftaran.step3'));
        $response->assertSessionHas('error'); 
    }

    /**
     * Fitur: Logic Gelombang
     * Tujuan: Tidak bisa daftar jika tidak ada gelombang aktif
     */
    public function test_registration_blocked_when_no_active_gelombang()
    {
        // Deactivate all gelombangs
        Gelombang::query()->update(['is_active' => false]);
        
        // Hit index which does the check
        $response = $this->actingAs($this->student)->get(route('pendaftaran.index'));
        
        // Controller returns view 'breeze.auth.register-closed'
        $response->assertStatus(200);
        $response->assertViewIs('breeze.auth.register-closed');
    }
}
