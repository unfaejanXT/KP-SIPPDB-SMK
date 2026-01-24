<?php

namespace Tests\Feature\Public;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PublicAccessTest extends TestCase
{
    /**
     * Fitur: Landing Page
     * Route: /
     */
    public function test_guest_can_view_landing_page()
    {
        // $response = $this->get('/');
        // $response->assertStatus(200);
        $this->markTestIncomplete('Test belum diimplementasikan.');
    }

    /**
     * Fitur: Lihat Pengumuman
     * Route: /pengumuman
     */
    public function test_guest_can_view_announcement_list()
    {
        $this->markTestIncomplete('Test belum diimplementasikan.');
    }

    /**
     * Fitur: Detail Pengumuman
     * Route: /pengumuman/{slug}
     */
    public function test_guest_can_view_announcement_detail()
    {
        $this->markTestIncomplete('Test belum diimplementasikan.');
    }

    /**
     * Fitur: Informasi Sekolah (Jadwal, Profil, Panduan)
     * Route: /profil, /panduan, /jadwal
     */
    public function test_guest_can_view_school_information_pages()
    {
        $this->markTestIncomplete('Test belum diimplementasikan.');
    }
}
