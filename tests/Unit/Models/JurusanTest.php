<?php

namespace Tests\Unit\Models;

use App\Models\Jurusan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class JurusanTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Clear seeded data to ensure clean state for count assertions
        Jurusan::query()->delete();
    }

    public function test_can_create_jurusan()
    {
        $jurusan = Jurusan::create([
            'kode' => 'RPL',
            'nama' => 'Rekayasa Perangkat Lunak',
            'deskripsi' => 'Jurusan IT',
            'kuota' => 100,
            'status' => 'aktif'
        ]);

        $this->assertDatabaseHas('jurusan', ['kode' => 'RPL']);
    }

    public function test_scope_aktif()
    {
        Jurusan::create(['kode' => 'A', 'nama' => 'A', 'kuota' => 10, 'status' => 'aktif']);
        Jurusan::create(['kode' => 'B', 'nama' => 'B', 'kuota' => 10, 'status' => 'nonaktif']);

        $activeJurusan = Jurusan::aktif()->get();

        $this->assertCount(1, $activeJurusan);
        $this->assertEquals('A', $activeJurusan->first()->kode);
    }

    public function test_scope_kuota_tersedia()
    {
        Jurusan::create(['kode' => 'A', 'nama' => 'A', 'kuota' => 10, 'status' => 'aktif']);
        Jurusan::create(['kode' => 'B', 'nama' => 'B', 'kuota' => 0, 'status' => 'aktif']);

        $available = Jurusan::kuotaTersedia()->get();

        $this->assertCount(1, $available);
        $this->assertEquals('A', $available->first()->kode);
    }

    public function test_kurangi_kuota()
    {
        $jurusan = Jurusan::create(['kode' => 'A', 'nama' => 'A', 'kuota' => 10, 'status' => 'aktif']);
        
        $result = $jurusan->kurangiKuota();

        $this->assertTrue($result);
        $this->assertEquals(9, $jurusan->fresh()->kuota);
    }

    public function test_kurangi_kuota_fails_if_empty()
    {
        $jurusan = Jurusan::create(['kode' => 'A', 'nama' => 'A', 'kuota' => 0, 'status' => 'aktif']);
        
        $result = $jurusan->kurangiKuota();

        $this->assertFalse($result);
        $this->assertEquals(0, $jurusan->fresh()->kuota);
    }

    public function test_tambah_kuota()
    {
        $jurusan = Jurusan::create(['kode' => 'A', 'nama' => 'A', 'kuota' => 10, 'status' => 'aktif']);
        
        $jurusan->tambahKuota(5);

        $this->assertEquals(15, $jurusan->fresh()->kuota);
    }
}
