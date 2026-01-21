<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pendaftaran;
use App\Models\Berkas;
use App\Models\Jurusan;
use Illuminate\Validation\Rule;

class StudentDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $pendaftaran = Pendaftaran::with('jurusan')->where('user_id', $user->id)->first();
        
        $berkasCount = 0;
        if ($pendaftaran) {
            $berkasCount = Berkas::where('pendaftaran_id', $pendaftaran->id)->count();
        }

        // Calculate progress
        $progress = 20; // 20% for account creation
        $steps = [
            'akun' => true,
            'formulir' => false,
            'berkas' => false,
            'verifikasi' => false,
            'pengumuman' => false,
        ];

        if ($pendaftaran) {
            $progress = 40;
            $steps['formulir'] = true;

            if ($berkasCount > 0) {
                // Assuming minimum required files are uploaded or just checking if any exist
                $progress = 60;
                $steps['berkas'] = true;
            }

            if ($pendaftaran->status != 'draft' && $pendaftaran->status != 'menunggu_verifikasi' && $pendaftaran->status != 'Menunggu') {
                 // Adjust status checks according to your specific status values
                 // For now assuming if status is processed/verified
                 if(in_array($pendaftaran->status, ['terverifikasi', 'diterima', 'ditolak'])) {
                    $progress = 80;
                    $steps['verifikasi'] = true;
                 }
            }

             if ($pendaftaran->status == 'diterima' || $pendaftaran->status == 'ditolak') {
                $progress = 100;
                $steps['pengumuman'] = true;
            }
        }

        if ($pendaftaran && !in_array($pendaftaran->status, ['submitted', 'terverifikasi', 'diterima', 'ditolak'])) {
            return redirect()->route('pendaftaran.index');
        } elseif (!$pendaftaran) {
             return redirect()->route('pendaftaran.index');
        }

        return view('siswa.dashboard', compact('user', 'pendaftaran', 'progress', 'steps'));
    }

    public function edit()
    {
        $user = Auth::user();
        $pendaftaran = Pendaftaran::with('jurusan')->where('user_id', $user->id)->firstOrFail(); // Must exist to edit
        $jurusans = Jurusan::all();
        
        return view('siswa.edit', compact('user', 'pendaftaran', 'jurusans'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $pendaftaran = Pendaftaran::where('user_id', $user->id)->firstOrFail();

        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:50',
            // 'nisn' => 'required|string|max:10|unique:pendaftaran,nisn,' . $pendaftaran->id, // Usually NISN shouldn't change, but if allowed:
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'required|string|max:50',
            'tanggal_lahir' => 'required|date',
            'agama' => 'required|string|max:20',
            'nomor_hp' => 'required|string|max:15',
            'jurusan_id' => 'required|exists:jurusan,id',
            'alamat_rumah' => 'required|string|max:255',
            'asal_sekolah' => 'required|string|max:100',
        ]);

        $pendaftaran->update($validated);
        
        return redirect()->route('pendaftaran.edit')->with('success', 'Data pendaftaran berhasil diperbarui.');
    }
    public function pengumuman()
    {
        $pengumuman = \App\Models\Pengumuman::where('status', 'published')
            ->orderBy('is_pinned', 'desc')
            ->latest()
            ->get();
        return view('siswa.pengumuman', compact('pengumuman'));
    }

    public function kelolaBerkas()
    {
        return view('siswa.kelola-berkas');
    }

    public function cetakBukti()
    {
        return view('siswa.cetak-bukti');
    }
}
