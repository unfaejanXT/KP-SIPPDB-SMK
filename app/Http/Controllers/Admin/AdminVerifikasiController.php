<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

use App\Models\Pendaftaran;
use App\Models\Berkas;
use Illuminate\Http\Request;

class AdminVerifikasiController extends Controller
{
    public function index(Request $request)
    {
        $query = Pendaftaran::with(['berkas.jenisBerkas', 'jurusan']);

        // Pencarian data pendaftaran berdasarkan nama atau NISN
        if ($request->has('search') && $request->search != '') {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                  ->orWhere('nisn', 'like', "%{$search}%");
            });
        }

        // Filter data berdasarkan status verifikasi berkas
        if ($request->has('status') && $request->get('status') != '') {
            $status = $request->get('status');
            $query->whereHas('berkas', function($q) use ($status) {
                if ($status == 'pending') {
                    $q->where(function($sub) {
                        $sub->whereNull('status_verifikasi')->orWhere('status_verifikasi', 'pending');
                    });
                } else {
                    $q->where('status_verifikasi', $status);
                }
            });
        }

        $pendaftarans = $query->latest()->paginate(10);
        
        $stats = [
            'pending' => Berkas::where(function($q) {
                $q->whereNull('status_verifikasi')->orWhere('status_verifikasi', 'pending');
            })->count(),
            'verified' => Berkas::where('status_verifikasi', 'verified')->count(),
            'rejected' => Berkas::where('status_verifikasi', 'rejected')->count(),
        ];

        return view('admin.verifikasi.index', compact('pendaftarans', 'stats'));
    }

    public function show(Pendaftaran $pendaftaran)
    {
        $pendaftaran->load(['berkas.jenisBerkas', 'jurusan']);
        return view('admin.verifikasi.show', compact('pendaftaran'));
    }

    public function updateStatus(Request $request, Berkas $berkas)
    {
        $request->validate([
            'status' => 'required|in:pending,verified,rejected',
            'catatan' => 'nullable|string'
        ]);

        $berkas->update([
            'status_verifikasi' => $request->status,
            'catatan_verifikasi' => $request->catatan,
            'verified_at' => now()
        ]);

        // Memeriksa status verifikasi semua berkas milik pendaftar
        $pendaftaran = $berkas->pendaftaran;
        
        $totalBerkas = $pendaftaran->berkas()->count();
        $verifiedCount = $pendaftaran->berkas()->where('status_verifikasi', 'verified')->count();
        $rejectedCount = $pendaftaran->berkas()->where('status_verifikasi', 'rejected')->count();
        $pendingCount = $pendaftaran->berkas()->where(function($q) {
            $q->whereNull('status_verifikasi')->orWhere('status_verifikasi', 'pending');
        })->count();

        if ($totalBerkas > 0 && $totalBerkas == $verifiedCount) {
            $pendaftaran->update(['status' => 'terverifikasi']);
        } elseif ($request->status == 'rejected') {
            $pendaftaran->update(['status' => 'ditolak']);
        } elseif ($pendingCount == 0 && $rejectedCount > 0) {
            // Jika baru saja memverifikasi berkas, tetapi masih ada berkas yang ditolak dan tidak ada berkas pending tersisa
            $pendaftaran->update(['status' => 'ditolak']);
        }

        return back()->with('success', 'Status berkas berhasil diperbarui');
    }

    public function verifyAll(Pendaftaran $pendaftaran)
    {
        $pendaftaran->berkas()->update([
            'status_verifikasi' => 'verified',
            'verified_at' => now()
        ]);

        $pendaftaran->update(['status' => 'terverifikasi']);

        return back()->with('success', 'Semua berkas berhasil diverifikasi');
    }

    public function download(Berkas $berkas)
    {
        if (Storage::disk('public')->exists($berkas->file_path)) {
            return Storage::disk('public')->download($berkas->file_path);
        }
        
        return back()->with('error', 'File tidak ditemukan.');
    }
}
