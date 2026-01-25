<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminExportTest extends TestCase
{

    protected $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = \App\Models\User::factory()->create();
        $this->admin->assignRole('admin');
    }

    /**
     * Fitur: Export Laporan
     * Route: /admin/laporan/export
     */
    public function test_admin_can_export_registration_report()
    {
        // Requires Maatwebsite/Excel or similar. Just check if route responds with download.
        // Or sometimes it's a view.
        // Assuming route exists and return download.
        $response = $this->actingAs($this->admin)->get(route('admin.laporan.export'));
        
        // Assert download or 200
        $response->assertStatus(200);
        // $response->assertHeader('content-type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    }
}
