<?php

namespace Tests\Feature\Public;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Database\Seeders\JurusanSeeder;
use Database\Seeders\PeriodePPDBSeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\AdminSeeder;

class PublicAccessTest extends TestCase
{
    use RefreshDatabase;

    // setUp is handled by parent TestCase


    public function test_homepage_is_accessible(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        // Verify key public information is present
        $response->assertSee('Pilih Masa Depanmu'); 
    }

    public function test_profil_page_is_accessible(): void
    {
        $response = $this->get('/profil');
        $response->assertStatus(200);
    }

    public function test_panduan_page_is_accessible(): void
    {
        $response = $this->get('/panduan');
        $response->assertStatus(200);
    }

    public function test_jadwal_page_is_accessible(): void
    {
        $response = $this->get('/jadwal');
        $response->assertStatus(200);
    }

    public function test_pengumuman_page_is_accessible(): void
    {
        $response = $this->get('/pengumuman');
        $response->assertStatus(200);
    }
}
