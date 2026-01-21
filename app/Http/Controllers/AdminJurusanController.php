<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class AdminJurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jurusans = Jurusan::withCount('pendaftaran')->get();
        
        $stats = [
            'total_jurusan' => $jurusans->count(),
            'total_kuota' => $jurusans->sum('kuota'),
            'total_pendaftar' => Pendaftaran::count(),
        ];
        
        $stats['kepenuhan'] = $stats['total_kuota'] > 0 
            ? round(($stats['total_pendaftar'] / $stats['total_kuota']) * 100) 
            : 0;

        return view('admin.jurusan.index', compact('jurusans', 'stats'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode' => 'required|string|max:10|unique:jurusan,kode',
            'nama' => 'required|string|max:100|unique:jurusan,nama',
            'deskripsi' => 'nullable|string',
            'kuota' => 'required|integer|min:0',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        Jurusan::create($validated);

        return redirect()->route('admin.jurusan.index')->with('success', 'Jurusan berhasil ditambahkan.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jurusan $jurusan)
    {
        $validated = $request->validate([
            'kode' => 'required|string|max:10|unique:jurusan,kode,' . $jurusan->id,
            'nama' => 'required|string|max:100|unique:jurusan,nama,' . $jurusan->id,
            'deskripsi' => 'nullable|string',
            'kuota' => 'required|integer|min:0',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        $jurusan->update($validated);

        return redirect()->route('admin.jurusan.index')->with('success', 'Jurusan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jurusan $jurusan)
    {
        // Cek dependencies jika perlu, misalnya apakah ada pendaftar
        if ($jurusan->pendaftaran()->exists()) {
            return back()->with('error', 'Tidak dapat menghapus jurusan yang memiliki pendaftar.');
        }

        $jurusan->delete();

        return redirect()->route('admin.jurusan.index')->with('success', 'Jurusan berhasil dihapus.');
    }
}
