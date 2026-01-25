<?php

namespace Tests\Unit\Models;

use App\Models\User;
use App\Models\Pengumuman;
use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PengumumanTest extends TestCase
{
    use RefreshDatabase;

    public function test_scope_for_user()
    {
        // 1. General Public Announcement
        Pengumuman::create([
            'judul' => 'Public Info', 'slug' => 'public-info', 'kategori' => 'info', 'konten' => 'abc', 
            'status' => 'published', 'target_roles' => null
        ]);

        // 2. Specific Role Announcement
        Pengumuman::create([
            'judul' => 'Admin Info', 'slug' => 'admin-info', 'kategori' => 'info', 'konten' => 'abc', 
            'status' => 'published', 'target_roles' => ['admin']
        ]);

        // User without role
        $user = User::factory()->create();
        $announcements = Pengumuman::forUser($user)->get();
        // Should catch Public only
        $this->assertEquals(1, $announcements->count());
        $this->assertEquals('Public Info', $announcements->first()->judul);

        // User with admin role
        $role = Role::create(['name' => 'admin']);
        $user->assignRole($role);
        
        $announcements2 = Pengumuman::forUser($user)->get();
        // Should catch both
        $this->assertEquals(2, $announcements2->count());
    }
}
