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

    protected $admin;
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->admin = \App\Models\User::factory()->create();
        $this->admin->assignRole('admin');

        $this->user = \App\Models\User::factory()->create();
        $this->user->assignRole('user');
    }

    /**
     * Fitur: Dashboard Admin
     * Route: /admin/dashboard
     */
    public function test_admin_can_access_dashboard()
    {
        $response = $this->actingAs($this->admin)->get(route('admin.dashboard'));
        $response->assertStatus(200);
        $response->assertViewIs('admin.dashboard');
    }

    /**
     * Fitur: Keamanan
     * Tujuan: Siswa/Guest tidak boleh akses dashboard admin
     */
    public function test_unauthorized_users_cannot_access_admin_dashboard()
    {
        // Test as normal user
        $response = $this->actingAs($this->user)->get(route('admin.dashboard'));
        
        if ($response->status() === 302) {
             $response->assertStatus(302);
        } else {
             $response->assertStatus(403);
        }


        // Logout to test as guest
        \Illuminate\Support\Facades\Auth::logout();
        // Clear session data to ensure cleaner state
        $this->app['session']->invalidate();
        $this->app['session']->regenerateToken();

        // Test as guest
        $response = $this->get(route('admin.dashboard'));
        $response->assertRedirect(route('login'));
    }
    
    /**
     * Fitur: Kelola Calon Siswa
     * Route: /admin/calon-siswa
     */
    public function test_admin_can_view_student_list()
    {
        $response = $this->actingAs($this->admin)->get(route('admin.calon-siswa.index'));
        $response->assertStatus(200);
        $response->assertSee('Data Calon Siswa'); // Adjust based on actual view content
    }
}
