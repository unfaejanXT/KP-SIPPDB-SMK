<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminPengumumanController extends Controller
{
    public function index()
    {
        $pengumuman = Pengumuman::latest()->get();
        return view('admin.pengumuman.index', compact('pengumuman'));
    }

    public function create()
    {
        $targets = [
            'public' => 'Umum (Semua Pengunjung)',
            'calon_siswa' => 'Calon Siswa',
        ];
        return view('admin.pengumuman.create', compact('targets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'konten' => 'required|string',
            'status' => 'required|in:draft,published',
            'target_roles' => 'nullable|array',
        ], [
            'judul.required' => 'Please fill out this field', // Pesan kustom untuk judul
            'konten.required' => 'Konten pengumuman harus diisi', // Pesan kustom untuk konten
        ]);

        Pengumuman::create([
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul),
            'kategori' => $request->kategori,
            'konten' => $request->konten,
            'is_pinned' => $request->has('is_pinned'),
            'target_roles' => $request->target_roles ?? ['public'],
            'status' => $request->status,
        ]);

        return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman berhasil dibuat.');
    }

    public function edit(Pengumuman $pengumuman)
    {
        $targets = [
            'public' => 'Umum (Semua Pengunjung)',
            'calon_siswa' => 'Calon Siswa',
        ];
        return view('admin.pengumuman.edit', compact('pengumuman', 'targets'));
    }

    public function update(Request $request, Pengumuman $pengumuman)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'konten' => 'required|string',
            'status' => 'required|in:draft,published',
            'target_roles' => 'nullable|array',
        ], [
            'judul.required' => 'Please fill out this field',
            'konten.required' => 'Konten pengumuman harus diisi',
        ]);

        $pengumuman->update([
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul),
            'kategori' => $request->kategori,
            'konten' => $request->konten,
            'is_pinned' => $request->has('is_pinned'),
            'target_roles' => $request->target_roles ?? ['public'],
            'status' => $request->status,
        ]);

        return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman berhasil diperbarui.');
    }

    public function destroy(Pengumuman $pengumuman)
    {
        $pengumuman->delete();
        return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman berhasil dihapus.');
    }

    public function toggleStatus(Pengumuman $pengumuman)
    {
        $pengumuman->status = $pengumuman->status === 'published' ? 'draft' : 'published';
        $pengumuman->save();

        return back()->with('success', 'Status pengumuman berhasil diubah.');
    }
}
