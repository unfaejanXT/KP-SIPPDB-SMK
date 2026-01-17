<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berkas;
use Illuminate\Http\Request;

class BerkasController extends Controller
{
    // Menampilkan daftar berkas yang perlu diverifikasi
    public function index()
    {
        // Mengambil semua berkas yang belum terverifikasi
        $berkas = Berkas::with('pendaftaran.user')
                       ->where('status_verifikasi', '!=', 'verified')
                       ->get();

        return view('admin.berkas.index', compact('berkas'));
    }

    // Halaman untuk melakukan verifikasi berkas
    public function verify($id)
    {
        // Menampilkan form verifikasi berdasarkan id berkas
        $berkas = Berkas::with('pendaftaran.user')->findOrFail($id);

        return view('admin.berkas.verify', compact('berkas'));
    }

    // Memperbarui status verifikasi berkas
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'status_verifikasi' => 'required|in:verified,rejected',
            'catatan_verifikasi' => 'nullable|string|max:255',
        ]);

        // Mengambil berkas yang akan diverifikasi
        $berkas = Berkas::findOrFail($id);

        // Melakukan verifikasi
        $berkas->verifikasi($request->status_verifikasi, $request->catatan_verifikasi);

        // Jika berkas terverifikasi, update status user
        if ($berkas->isTerverifikasi()) {
            $user = $berkas->pendaftaran->user;
            $user->update([
                'status_verifikasi' => 'verified',  // Bisa menambahkan field lain jika diperlukan
            ]);
        }

        return redirect()->route('admin.berkas.index')->with('success', 'Berkas berhasil diverifikasi.');
    }
}
