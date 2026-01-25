<?php

namespace App\Http\Controllers\CalonSiswa;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pendaftaran;
use App\Models\Berkas;
use App\Models\Jurusan;
use App\Models\OrangTuaSiswa;
use Illuminate\Validation\Rule;

class CalonSiswaDashboardController extends Controller
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
        $pendaftaran = Pendaftaran::with('jurusan')->where('user_id', $user->id)->firstOrFail();

        // Check if locked
        if (in_array($pendaftaran->status, ['terverifikasi', 'diterima', 'ditolak'])) {
            return redirect()->route('dashboard')->with('error', 'Data tidak dapat diubah karena sudah diverifikasi/final.');
        }

        $jurusans = Jurusan::all();
        
        return view('siswa.edit', compact('user', 'pendaftaran', 'jurusans'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $pendaftaran = Pendaftaran::where('user_id', $user->id)->firstOrFail();

        // Check if locked
        if (in_array($pendaftaran->status, ['terverifikasi', 'diterima', 'ditolak'])) {
            return redirect()->route('dashboard')->with('error', 'Data tidak dapat diubah karena sudah diverifikasi/final.');
        }

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
    public function pengumuman(Request $request)
    {
        $query = \App\Models\Pengumuman::forUser(Auth::user());

        if ($request->has('q')) {
            $search = $request->q;
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('konten', 'like', "%{$search}%");
            });
        }

        $pengumuman = $query->orderBy('is_pinned', 'desc')
            ->latest()
            ->paginate(5);
            
        return view('siswa.pengumuman', compact('pengumuman'));
    }

    public function showPengumuman($slug)
    {
        $pengumuman = \App\Models\Pengumuman::forUser(Auth::user())
            ->where('slug', $slug)
            ->firstOrFail();

        return view('siswa.pengumuman-detail', compact('pengumuman'));
    }

    public function kelolaBerkas()
    {
        $user = Auth::user();
        $pendaftaran = Pendaftaran::where('user_id', $user->id)->firstOrFail();
        
        $uploadedBerkas = Berkas::with('jenisBerkas')->where('pendaftaran_id', $pendaftaran->id)->get();
        $jenisBerkas = \App\Models\JenisBerkas::where('is_active', true)->get();

        return view('siswa.kelola-berkas', compact('pendaftaran', 'uploadedBerkas', 'jenisBerkas'));
    }

    public function cetakBukti()
    {
        $user = Auth::user();
        $pendaftaran = Pendaftaran::with('jurusan', 'gelombang')->where('user_id', $user->id)->firstOrFail();
        $orangtua = OrangTuaSiswa::where('pendaftaran_id', $pendaftaran->id)->first();
        
        return view('siswa.cetak-bukti', compact('pendaftaran', 'orangtua'));
    }

    public function editOrangTua()
    {
        $user = Auth::user();
        $pendaftaran = Pendaftaran::with('orangTua')->where('user_id', $user->id)->firstOrFail();
        
        // Cek status untuk lock form
        $isLocked = in_array($pendaftaran->status, ['terverifikasi', 'diterima', 'ditolak']);

        return view('siswa.edit-orangtua', compact('user', 'pendaftaran', 'isLocked'));
    }

    public function updateOrangTua(Request $request)
    {
        $user = Auth::user();
        $pendaftaran = Pendaftaran::where('user_id', $user->id)->firstOrFail();

        if (in_array($pendaftaran->status, ['terverifikasi', 'diterima', 'ditolak'])) {
             return redirect()->route('pendaftaran.edit.orangtua')->with('error', 'Maaf, data tidak dapat diubah karena status pendaftaran sudah diproses/verifikasi final.');
        }

        $validated = $request->validate([
            'nama_ayah' => 'required|string|max:100',
            'pekerjaan_ayah' => 'required|string|max:50',
            'penghasilan_ayah' => 'required|numeric|min:0',
            'nama_ibu' => 'required|string|max:100',
            'pekerjaan_ibu' => 'required|string|max:50',
            'penghasilan_ibu' => 'required|numeric|min:0',
            'no_hp_orangtua' => 'required|string|max:20',
            'nama_wali' => 'nullable|string|max:100',
            'pekerjaan_wali' => 'nullable|string|max:50',
            'penghasilan_wali' => 'nullable|numeric|min:0',
            'no_hp_wali' => 'nullable|string|max:20',
            'alamat_wali' => 'nullable|string',
        ]);

        OrangTuaSiswa::updateOrCreate(
            ['pendaftaran_id' => $pendaftaran->id],
            $validated
        );

        return redirect()->route('pendaftaran.edit.orangtua')->with('success', 'Data orang tua berhasil diperbarui.');
    }
}
