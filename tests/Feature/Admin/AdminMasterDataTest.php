<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminMasterDataTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Fitur: Kelola Jurusan
     * Route: /admin/jurusan
     */

    protected $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = \App\Models\User::factory()->create();
        $this->admin->assignRole('admin');
    }

    /**
     * Fitur: Kelola Jurusan
     * Route: /admin/jurusan
     */
    public function test_admin_can_crud_jurusan()
    {
        // Index
        $response = $this->actingAs($this->admin)->get(route('admin.jurusan.index'));
        $response->assertStatus(200);

        // Create
        $jurusanData = [
            'kode' => 'RPLTEST',
            'nama' => 'Rekayasa Perangkat Lunak Test',
            'deskripsi' => 'Jurusan TI',
            'kuota' => 100,
            'status' => 'aktif'
        ];
        $response = $this->actingAs($this->admin)->post(route('admin.jurusan.store'), $jurusanData);
        $response->assertRedirect(route('admin.jurusan.index'));
        $this->assertDatabaseHas('jurusan', ['kode' => 'RPLTEST']);
    }

    /**
     * Fitur: Kelola Gelombang
     * Route: /admin/gelombang
     */
    public function test_admin_can_crud_gelombang()
    {
        // Get periode first
        $periode = \App\Models\Periode::first();
        if(!$periode) {
             $periode = \App\Models\Periode::create([
                'nama_periode' => '2026/2027', 
                'tahun_ajaran' => '2026/2027',
                'tanggal_mulai' => now(), 
                'tanggal_selesai' => now()->addYear(), 
                'is_active' => true
             ]);
        }

        // Index
        $response = $this->actingAs($this->admin)->get(route('admin.gelombang.index'));
        $response->assertStatus(200);

        // Create
        $gelombangData = [
            'nama' => 'Gelombang Test',
            'periode_id' => $periode->id,
            'tanggal_mulai' => now()->format('Y-m-d'),
            'tanggal_selesai' => now()->addMonth()->format('Y-m-d'),
            'tahun_ajaran' => $periode->tahun_ajaran,
            'kuota' => 50,
            'is_active' => 1
        ];
        
        $response = $this->actingAs($this->admin)->post(route('admin.gelombang.store'), $gelombangData);
        $response->assertRedirect(route('admin.gelombang.index'));
        $this->assertDatabaseHas('gelombangs', ['nama' => 'Gelombang Test']);
    }

    /**
     * Fitur: Kelola Periode
     * Route: /admin/periode
     */
    public function test_admin_can_crud_periode()
    {
        // Index
        $response = $this->actingAs($this->admin)->get(route('admin.periode.index'));
        $response->assertStatus(200);

        // Create
        $periodeData = [
            'nama_periode' => 'Periode Test 2030',
            'tahun_ajaran' => '2030/2031',
            'tanggal_mulai' => '2030-01-01',
            'tanggal_selesai' => '2030-12-31',
            'is_active' => 0
        ];
        $response = $this->actingAs($this->admin)->post(route('admin.periode.store'), $periodeData);
        $response->assertRedirect(route('admin.periode.index'));
        $this->assertDatabaseHas('periodes', ['nama_periode' => 'Periode Test 2030']); 
    }

    /**
     * Fitur: Kelola Pengumuman
     * Route: /admin/pengumuman
     */
    public function test_admin_can_crud_pengumuman()
    {
        // Index
        $response = $this->actingAs($this->admin)->get(route('admin.pengumuman.index'));
        $response->assertStatus(200);

        // Create
        $pengumumanData = [
            'judul' => 'Pengumuman Penting',
            'kategori' => 'Umum',
            'konten' => 'Isi pengumuman...',
            'status' => 'published',
            'is_pinned' => 0
        ];
        $response = $this->actingAs($this->admin)->post(route('admin.pengumuman.store'), $pengumumanData);
        $response->assertRedirect(route('admin.pengumuman.index'));
        $this->assertDatabaseHas('pengumuman', ['judul' => 'Pengumuman Penting']);
    }
}
