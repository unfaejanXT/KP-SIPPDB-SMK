<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminDashboardTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Fitur: Dashboard Admin
     * Route: /admin/dashboard
     */
    public function test_admin_can_access_dashboard()
    {
        $this->markTestIncomplete('Test belum diimplementasikan.');
    }

    /**
     * Fitur: Keamanan
     * Tujuan: Siswa/Guest tidak boleh akses dashboard admin
     */
    public function test_unauthorized_users_cannot_access_admin_dashboard()
    {
        $this->markTestIncomplete('Test belum diimplementasikan.');
    }
    
    /**
     * Fitur: Kelola Calon Siswa
     * Route: /admin/calon-siswa
     */
    public function test_admin_can_view_student_list()
    {
        $this->markTestIncomplete('Test belum diimplementasikan.');
    }
}
