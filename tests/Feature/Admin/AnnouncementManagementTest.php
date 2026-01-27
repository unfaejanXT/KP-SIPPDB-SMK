<?php

namespace Tests\Feature\Admin;

use App\Models\Pengumuman;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AnnouncementManagementTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $admin;

    protected function setUp(): void
    {
        parent::setUp();
        // The TestCase automatically calls AdminSeeder
        $this->admin = User::where('email', 'test@admin.com')->first();
    }

    /**
     * Test Case 1: Mengakses halaman kelola pengumuman
     */
    public function test_access_announcement_management_page()
    {
        $response = $this->actingAs($this->admin)
            ->get(route('admin.pengumuman.index'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.pengumuman.index');
        $response->assertSee('Kelola Pengumuman');
        $response->assertSee('Daftar Pengumuman');
    }

    /**
     * Test Case 2: Menambah pengumuman baru
     */
    public function test_access_add_new_announcement_page()
    {
        $response = $this->actingAs($this->admin)
            ->get(route('admin.pengumuman.create'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.pengumuman.create');
        $response->assertSee('Buat Pengumuman Baru'); // Assuming title or similar text exists
    }

    /**
     * Test Case 3: Mengisi form pengumuman dengan judul kosong
     */
    public function test_validate_empty_title_on_create()
    {
        $data = [
            'judul' => '',
            'kategori' => 'Informasi',
            'konten' => 'Isi konten',
            'status' => 'published',
            'target_roles' => ['public'],
        ];

        $response = $this->actingAs($this->admin)
            ->from(route('admin.pengumuman.create'))
            ->post(route('admin.pengumuman.store'), $data);

        $response->assertRedirect(route('admin.pengumuman.create'));
        $response->assertSessionHasErrors(['judul' => 'Please fill out this field']);
    }

    /**
     * Test Case 4: Mengisi form pengumuman dengan konten kosong
     */
    public function test_validate_empty_content_on_create()
    {
        $data = [
            'judul' => 'Judul Valid',
            'kategori' => 'Informasi',
            'konten' => '',
            'status' => 'published',
            'target_roles' => ['public'],
        ];

        $response = $this->actingAs($this->admin)
            ->from(route('admin.pengumuman.create'))
            ->post(route('admin.pengumuman.store'), $data);

        $response->assertRedirect(route('admin.pengumuman.create'));
        $response->assertSessionHasErrors(['konten' => 'Konten pengumuman harus diisi']);
    }

    /**
     * Test Case 5: Mengisi form pengumuman dengan lengkap
     */
    public function test_successfully_create_announcement()
    {
        $data = [
            'judul' => 'Pembukaan PPDB 2024',
            'kategori' => 'Informasi',
            'konten' => 'Detail pengumuman pembukaan PPDB.',
            'status' => 'published',
            'target_roles' => ['public'],
        ];

        $response = $this->actingAs($this->admin)
            ->post(route('admin.pengumuman.store'), $data);

        $response->assertRedirect(route('admin.pengumuman.index'));
        $response->assertSessionHas('success', 'Pengumuman berhasil dibuat.'); // Matching controller msg

        $this->assertDatabaseHas('pengumuman', [
            'judul' => 'Pembukaan PPDB 2024',
            'konten' => 'Detail pengumuman pembukaan PPDB.',
        ]);
    }

    /**
     * Test Case 6: Mengedit pengumuman
     */
    public function test_access_edit_announcement_page()
    {
        $pengumuman = Pengumuman::create([
            'judul' => 'Old Title',
            'slug' => 'old-title',
            'kategori' => 'Informasi',
            'konten' => 'Old Content',
            'status' => 'draft',
            'target_roles' => ['public'],
            'user_id' => $this->admin->id,
        ]);

        $response = $this->actingAs($this->admin)
            ->get(route('admin.pengumuman.edit', $pengumuman));

        $response->assertStatus(200);
        $response->assertViewIs('admin.pengumuman.edit');
        $response->assertSee('Old Title');
    }

    /**
     * Test Case 7: Mengubah judul pengumuman
     */
    public function test_successfully_update_announcement()
    {
        $pengumuman = Pengumuman::create([
            'judul' => 'Old Title',
            'slug' => 'old-title',
            'kategori' => 'Informasi',
            'konten' => 'Old Content',
            'status' => 'draft',
            'target_roles' => ['public'],
            'user_id' => $this->admin->id,
        ]);

        $data = [
            'judul' => 'Pembukaan PPDB 2024 Updated',
            'kategori' => 'Informasi',
            'konten' => 'Old Content',
            'status' => 'published',
            'target_roles' => ['public'],
        ];

        $response = $this->actingAs($this->admin)
            ->put(route('admin.pengumuman.update', $pengumuman), $data);

        $response->assertRedirect(route('admin.pengumuman.index'));
        $response->assertSessionHas('success', 'Pengumuman berhasil diperbarui.');

        $this->assertDatabaseHas('pengumuman', [
            'id' => $pengumuman->id,
            'judul' => 'Pembukaan PPDB 2024 Updated',
            'status' => 'published',
        ]);
    }

    /**
     * Test Case 8 & 9: Menghapus pengumuman & Mengkonfirmasi penghapusan
     * Note: Feature tests verify the server response to DELETE request.
     * The modal works on client side, but we assume if we hit the route, it deletes.
     */
    public function test_successfully_delete_announcement()
    {
        $pengumuman = Pengumuman::create([
            'judul' => 'To Be Deleted',
            'slug' => 'to-be-deleted',
            'kategori' => 'Informasi',
            'konten' => 'Content',
            'status' => 'draft',
            'target_roles' => ['public'],
            'user_id' => $this->admin->id,
        ]);

        $response = $this->actingAs($this->admin)
            ->delete(route('admin.pengumuman.destroy', $pengumuman));

        $response->assertRedirect(route('admin.pengumuman.index'));
        $response->assertSessionHas('success', 'Pengumuman berhasil dihapus.');

        $this->assertDatabaseMissing('pengumuman', [
            'id' => $pengumuman->id,
        ]);
    }

    /**
     * Test Case 10: Mempublikasikan pengumuman
     */
    public function test_publish_announcement_toggle()
    {
        $pengumuman = Pengumuman::create([
            'judul' => 'Draft Announcement',
            'slug' => 'draft-announcement',
            'kategori' => 'Informasi',
            'konten' => 'Content',
            'status' => 'draft',
            'target_roles' => ['public'],
            'user_id' => $this->admin->id,
        ]);

        $response = $this->actingAs($this->admin)
            ->patch(route('admin.pengumuman.toggle-status', $pengumuman));

        $response->assertRedirect();
        $response->assertSessionHas('success', 'Status pengumuman berhasil diubah.');

        $this->assertDatabaseHas('pengumuman', [
            'id' => $pengumuman->id,
            'status' => 'published',
        ]);
    }
}
