<?php

namespace Tests\Feature\CalonSiswa;

use App\Models\User;
use App\Models\Gelombang;
use App\Models\Jurusan;
use App\Models\Pendaftaran;
use App\Models\JenisBerkas;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class DocumentUploadTest extends TestCase
{
    use RefreshDatabase;

    protected $student;
    protected $pendaftaran;
    protected $jenisBerkas;
    protected $jurusan;
    protected $gelombang;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->student = User::factory()->create();
        $this->student->assignRole('user');
        
        $this->gelombang = Gelombang::where('is_active', true)->first();
        if(!$this->gelombang) {
             $this->gelombang = Gelombang::create([
                 'nama_gelombang' => 'Gelombang 1',
                 'is_active' => true,
                 'tanggal_mulai' => now()->subDay(),
                 'tanggal_selesai' => now()->addMonth(),
             ]);
        }
        $this->jurusan = Jurusan::first() ?? Jurusan::create(['nama_jurusan' => 'RPL', 'kode_jurusan' => 'RPL', 'status' => 'aktif']);

        // Create Pendaftaran at step 3
        $this->pendaftaran = Pendaftaran::create([
            'user_id' => $this->student->id,
            'gelombang_id' => $this->gelombang->id,
            'jurusan_id' => $this->jurusan->id,
            'no_pendaftaran' => 'REG-TEST-001',
            'nisn' => '1234567890',
            'nama_lengkap' => 'Test Student',
            'jenis_kelamin' => 'L',
            'tempat_lahir' => 'Jakarta',
            'tanggal_lahir' => '2008-01-01',
            'agama' => 'Islam',
            'alamat_rumah' => 'Jl. Test',
            'nomor_hp' => '08123456789',
            'asal_sekolah' => 'SMP Pub',
            'status' => 'draft',
            'current_step' => 3
        ]);

        $this->jenisBerkas = JenisBerkas::create([
            'kode_berkas' => 'IJAZAH',
            'nama_berkas' => 'Ijazah',
            'is_wajib' => true,
            'is_active' => true
        ]);
        
        Storage::fake('public');
    }

    /**
     * Scenario 1: Upload foto dengan ekstensi .png (valid)
     */
    public function test_upload_png_file_valid()
    {
        $file = UploadedFile::fake()->image('foto.png', 500, 500)->size(500); // 500KB

        $response = $this->actingAs($this->student)->postJson(route('pendaftaran.upload'), [
            'kode_berkas' => $this->jenisBerkas->kode_berkas,
            'file' => $file
        ]);

        $response->assertStatus(200)
                 ->assertJson(['success' => true]);
    }

    /**
     * Scenario 2: Upload foto dengan ekstensi .jpg (valid)
     */
    public function test_upload_jpg_file_valid()
    {
        $file = UploadedFile::fake()->image('foto.jpg', 800, 800)->size(800); // 800KB

        $response = $this->actingAs($this->student)->postJson(route('pendaftaran.upload'), [
            'kode_berkas' => $this->jenisBerkas->kode_berkas,
            'file' => $file
        ]);

        $response->assertStatus(200)
                 ->assertJson(['success' => true]);
    }

    /**
     * Scenario 3: Upload dokumen PDF dengan ukuran 3.5MB (valid)
     */
    public function test_upload_pdf_file_valid_large()
    {
        $file = UploadedFile::fake()->create('dokumen.pdf', 3500); // 3.5MB = 3500KB

        $response = $this->actingAs($this->student)->postJson(route('pendaftaran.upload'), [
            'kode_berkas' => $this->jenisBerkas->kode_berkas,
            'file' => $file
        ]);

        $response->assertStatus(200)
                 ->assertJson(['success' => true]);
    }

    /**
     * Scenario 4: Upload dokumen dengan ekstensi .exe (Format file tidak didukung)
     */
    public function test_upload_exe_file_invalid()
    {
        $file = UploadedFile::fake()->create('app.exe', 100);

        $response = $this->actingAs($this->student)->postJson(route('pendaftaran.upload'), [
            'kode_berkas' => $this->jenisBerkas->kode_berkas,
            'file' => $file
        ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['file' => 'Format file tidak didukung']);
    }

    /**
     * Scenario 5: Upload dokumen PDF rusak/corrupt (File tidak valid atau rusak)
     */
    public function test_upload_corrupt_pdf_invalid()
    {
        // Simulate corrupt PDF: Correct extension, wrong mime/content
        $file = UploadedFile::fake()->create('corrupt.pdf', 100, 'text/plain');

        $response = $this->actingAs($this->student)->postJson(route('pendaftaran.upload'), [
            'kode_berkas' => $this->jenisBerkas->kode_berkas,
            'file' => $file
        ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['file' => 'File tidak valid atau rusak']);
    }
}
