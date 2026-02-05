<?php

namespace App\Http\Controllers\CalonSiswa;

use App\Http\Controllers\Controller;

use App\Models\Berkas;
use App\Models\Jurusan;
use App\Models\OrangTuaSiswa;
use App\Models\Pendaftaran;
use App\Models\Gelombang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PendaftaranController extends Controller
{
    /**
     * Titik awal Pendaftaran PPDB.
     * Menentukan langkah mana yang akan ditampilkan berdasarkan kemajuan pengguna.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }

        // Memeriksa apakah data pendaftaran ada
        $pendaftaran = Pendaftaran::where('user_id', $user->id)->first();

        if (!$pendaftaran) {
            // Memeriksa Gelombang PPDB yang aktif
            $activePeriod = Gelombang::where('is_active', true)
                ->whereDate('tanggal_mulai', '<=', now())
                ->whereDate('tanggal_selesai', '>=', now())
                ->first();
            if (!$activePeriod) {
                Auth::guard('web')->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return view('breeze.auth.register-closed', [
                    'title' => 'Terjadi Kesalahan',
                    'message' => 'Terjadi kesalahan di waktu pendaftaran, silahkan hubungi administrator sekolah.'
                ]);
            }

            // Membuat Draft Pendaftaran
            // Default jurusan_id 1 jika belum dipilih (akan diperbarui di Langkah 1) -> skema mengharuskannya jadi mungkin perlu nullable atau default.
            // Melihat skema: id, user_id, periodeppdb_id, jurusan_id diperlukan.
            // Kita tidak bisa memasukkan data tidak lengkap dengan mudah jika skema mencegahnya.
            // Strategi: Alihkan ke Formulir Langkah 1, dan lakukan "Insert Awal" HANYA ketika Langkah 1 disubmit.
            // TAPI diagram mengatakan: "Data pendaftaran sudah ada? (Tidak) -> Buat data pendaftaran (Insert awal: status=draft, current_step=0)".
            // Jika skema memerlukan jurusan_id segera, kita mungkin punya masalah jika memasukkan sebelum pengguna memilihnya.
            // Mari asumsikan kita bisa memilih default atau mengubah skema (terlalu berisiko).
            // LEBIH BAIK: Lanjutkan ke tampilan Langkah 1, tapi jangan masukkan record sampai Langkah 1 disubmit.
            // Sebenarnya diagram mengatakan "Insert awal" lalu "Redirect ke step (current_step + 1)". 0+1 = 1.
            // Jadi jika saya tidak insert, saya hanya menampilkan Langkah 1.
            
            return redirect()->route('pendaftaran.step1');
        }

        if (in_array($pendaftaran->status, ['submitted', 'terverifikasi', 'diterima', 'ditolak'])) {
            return redirect()->route('dashboard');
        }

        // Alihkan ke langkah yang sesuai
        $step = $pendaftaran->current_step + 1;
        
        // Batas aman
        if ($step < 1) $step = 1;
        if ($step > 4) $step = 4;

        return redirect()->route('pendaftaran.step' . $step);
    }

    // LANGKAH 1: Biodata
    public function step1()
    {
        $user = Auth::user();
        $pendaftaran = Pendaftaran::where('user_id', $user->id)->first();
        
        if ($pendaftaran && in_array($pendaftaran->status, ['submitted', 'terverifikasi', 'diterima', 'ditolak'])) {
             return redirect()->route('dashboard');
        }

        $jurusans = Jurusan::where('status', 'aktif')->get();
        // Kembalikan tampilan dengan data langkah 1
        return view('pendaftaran.create', [
            'step' => 1,
            'pendaftaran' => $pendaftaran,
            'jurusans' => $jurusans
        ]);
    }

    public function storeStep1(Request $request)
    {
        $user = Auth::user();
        $pendaftaran = Pendaftaran::where('user_id', $user->id)->first();
        
        // Validasi
        $validator = Validator::make($request->all(), [
            'nama_lengkap' => 'required|string|max:50',
            'nisn' => ['required', 'digits:10', 'unique:pendaftaran,nisn,' . ($pendaftaran->id ?? 'NULL')],
            'tempat_lahir' => 'required|string|max:50',
            'tanggal_lahir' => 'required|date|before:tomorrow',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'required|string',
            'jurusan_id' => 'required|exists:jurusan,id',
            'nomor_hp' => 'required|string|max:15|regex:/^[0-9]+$/',
            'asal_sekolah' => 'required|string|max:100',
            'alamat_rumah' => 'required|string',
            'ukuran_baju' => 'required|in:S,M,L,XL,XXL,XXXL',
        ], [
            'tanggal_lahir.before' => 'Tanggal lahir tidak valid'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Ambil Gelombang Aktif
        $activePeriod = Gelombang::where('is_active', true)
            ->whereDate('tanggal_mulai', '<=', now())
            ->whereDate('tanggal_selesai', '>=', now())
            ->first();
        if (!$activePeriod) {
            return redirect()->back()->with('error', 'Tidak ada gelombang PPDB yang aktif.');
        }

        // Buat atau Perbarui
        // Catatan: $pendaftaran sudah diambil di atas

        // Generate Nomor Pendaftaran jika baru
        $no_pendaftaran = $pendaftaran ? $pendaftaran->no_pendaftaran : 'REG-' . time() . '-' . rand(100,999);

        // Persiapkan data
        $data = [
            'user_id' => $user->id,
            'gelombang_id' => $activePeriod->id,
            'jurusan_id' => $request->jurusan_id,
            'no_pendaftaran' => $no_pendaftaran,
            'nisn' => $request->nisn,
            'nama_lengkap' => $request->nama_lengkap,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'agama' => $request->agama,
            'alamat_rumah' => $request->alamat_rumah,
            'nomor_hp' => $request->nomor_hp,
            'asal_sekolah' => $request->asal_sekolah,
            'ukuran_baju' => $request->ukuran_baju,
            'golongan_darah' => $request->golongan_darah,
            'status' => 'draft',
            'current_step' => 1 // Completed step 1
        ];

        if ($pendaftaran) {
            $pendaftaran->update($data);
        } else {
            Pendaftaran::create($data);
        }

        return redirect()->route('pendaftaran.step2');
    }

    // LANGKAH 2: Data Orang Tua
    public function step2()
    {
        $user = Auth::user();
        $pendaftaran = Pendaftaran::where('user_id', $user->id)->first();

        if (!$pendaftaran) return redirect()->route('pendaftaran.step1');
        if (in_array($pendaftaran->status, ['submitted', 'terverifikasi', 'diterima', 'ditolak'])) return redirect()->route('dashboard');

        $orangtua = OrangTuaSiswa::where('pendaftaran_id', $pendaftaran->id)->first();

        return view('pendaftaran.create', [
            'step' => 2,
            'pendaftaran' => $pendaftaran,
            'orangtua' => $orangtua,
             // kirim jurusans null untuk menghindari error di view partial jika dibagi
             'jurusans' => []
        ]);
    }

    public function storeStep2(Request $request)
    {
        $user = Auth::user();
        $pendaftaran = Pendaftaran::where('user_id', $user->id)->first();
        if (!$pendaftaran) return redirect()->route('pendaftaran.step1');

        $validator = Validator::make($request->all(), [
            'nama_ayah' => 'required|string|max:100',
            'pekerjaan_ayah' => 'required|string',
            'nama_ibu' => 'required|string|max:100',
            'pekerjaan_ibu' => 'required|string',
            'no_hp_orangtua' => 'nullable|regex:/^[0-9]+$/|max:20',
        ], [
            'no_hp_orangtua.regex' => 'Nomor HP Orang Tua harus berupa angka.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        OrangTuaSiswa::updateOrCreate(
            ['pendaftaran_id' => $pendaftaran->id],
            [
                'nama_ayah' => $request->nama_ayah,
                'pekerjaan_ayah' => $request->pekerjaan_ayah,
                'penghasilan_ayah' => $request->penghasilan_ayah ?? 0,
                'nama_ibu' => $request->nama_ibu,
                'pekerjaan_ibu' => $request->pekerjaan_ibu,
                'penghasilan_ibu' => $request->penghasilan_ibu ?? 0,
                'nama_wali' => $request->nama_wali,
                'pekerjaan_wali' => $request->pekerjaan_wali,
                'penghasilan_wali' => $request->penghasilan_wali ?? 0,
                'alamat_wali' => $request->alamat_wali,
                'no_hp_orangtua' => $request->no_hp_orangtua,
                // 'no_hp_wali' => $request->no_hp_wali // Add if exists in form
            ]
        );

        $pendaftaran->update(['current_step' => 2]);

        return redirect()->route('pendaftaran.step3');
    }

    // LANGKAH 3: Upload Berkas
    public function step3()
    {
        $user = Auth::user();
        $pendaftaran = Pendaftaran::where('user_id', $user->id)->first();

        if (!$pendaftaran) return redirect()->route('pendaftaran.step1');
        if (in_array($pendaftaran->status, ['submitted', 'terverifikasi', 'diterima', 'ditolak'])) return redirect()->route('dashboard');
        
        // Ambil file yang ada
        $uploadedBerkas = Berkas::with('jenisBerkas')->where('pendaftaran_id', $pendaftaran->id)->get();
        // Ambil semua tipe file yang tersedia
        $jenisBerkas = \App\Models\JenisBerkas::where('is_active', true)->get();

        return view('pendaftaran.create', [
            'step' => 3,
            'pendaftaran' => $pendaftaran,
            'uploadedBerkas' => $uploadedBerkas,
            'jenisBerkas' => $jenisBerkas,
             'jurusans' => []
        ]);
    }

    public function storeStep3(Request $request)
    {
        $user = Auth::user();
        $pendaftaran = Pendaftaran::where('user_id', $user->id)->firstOrFail();

        // Cek berkas wajib
        $uploadedJenisIds = Berkas::where('pendaftaran_id', $pendaftaran->id)
                               ->pluck('jenis_berkas_id')
                               ->toArray();
        
        $wajibBerkas = \App\Models\JenisBerkas::where('is_active', true)
                            ->where('is_wajib', true)
                            ->get();
        
        $missing = [];
        foreach ($wajibBerkas as $jb) {
            if (!in_array($jb->id, $uploadedJenisIds)) {
                $missing[] = $jb->nama_berkas;
            }
        }

        if (!empty($missing)) {
             $missingStr = implode(', ', $missing);
             return redirect()->back()->with('error', 'Harap upload berkas wajib berikut: ' . $missingStr);
        }

        $pendaftaran->update(['current_step' => 3]);

        return redirect()->route('pendaftaran.step4');
    }

    public function uploadBerkas(Request $request)
    {
         $request->validate([
            'file' => [
                'required',
                'file',
                'max:1024',
                function ($attribute, $value, $fail) {
                    $allowedExtensions = ['jpg', 'jpeg', 'png', 'pdf'];
                    $extension = strtolower($value->getClientOriginalExtension());
                    
                    if (!in_array($extension, $allowedExtensions)) {
                         $fail('Format file tidak didukung');
                         return;
                    }
                    
                    // Periksa tipe mime sebenarnya terhadap tipe yang diizinkan
                    // Catatan: getMimeType() menebak berdasarkan konten
                    $actualMime = $value->getMimeType();
                    $validMimes = ['image/jpeg', 'image/png', 'application/pdf'];
                    
                    if (!in_array($actualMime, $validMimes)) {
                        $fail('File tidak valid atau rusak');
                    }
                }
            ],
            'kode_berkas' => 'required|string|exists:jenis_berkas,kode_berkas'
        ], [
            'file.max' => 'Ukuran file terlalu besar (maksimal 1MB)',
            'file.file' => 'File tidak valid atau rusak',
            'file.uploaded' => 'File tidak valid atau rusak',
        ]);

        $user = Auth::user();
        $pendaftaran = Pendaftaran::where('user_id', $user->id)->firstOrFail();
        
        // Mencegah upload jika pendaftaran sudah difinalisasi
        if (in_array($pendaftaran->status, ['terverifikasi', 'diterima'])) {
            return response()->json([
                'success' => false,
                'message' => 'Pendaftaran sudah diverifikasi/final. Tidak dapat mengubah berkas.'
            ], 403);
        }

        $file = $request->file('file');
        $kode = $request->kode_berkas;
        
        // Cari ID Jenis Berkas
        $jenisBerkas = \App\Models\JenisBerkas::where('kode_berkas', $kode)->firstOrFail();

        $path = $file->store('berkas/' . $pendaftaran->nisn, 'public');
        
        $berkas = Berkas::updateOrCreate(
            [
                'pendaftaran_id' => $pendaftaran->id, 
                'jenis_berkas_id' => $jenisBerkas->id
            ],
            [
                'file_path' => $path,
                'status_verifikasi' => 'pending',
                'catatan_verifikasi' => null,
                'verified_at' => null,
                'uploaded_at' => now()
            ]
        );

        // Jika pas_foto, mungkin perbarui tabel pendaftaran juga jika diperlukan, tapi tidak mutlak diperlukan jika kita menggunakan Berkas
        if ($kode === 'pas_foto') {
            $pendaftaran->update(['pas_foto' => $path]);
        }

        // Jika data ditolak, perbarui status menjadi menunggu verifikasi lagi
        if (in_array($pendaftaran->status, ['ditolak'])) {
            $pendaftaran->update(['status' => 'menunggu_verifikasi']);
        }

        return response()->json([
            'success' => true,
            'message' => 'Berkas berhasil diupload',
            'url' => asset('storage/' . $path)
        ]);
    }

    // LANGKAH 4: Konfirmasi
    public function step4()
    {
        $user = Auth::user();
        $pendaftaran = Pendaftaran::where('user_id', $user->id)->first();

        if (!$pendaftaran) return redirect()->route('pendaftaran.step1');
        if (in_array($pendaftaran->status, ['submitted', 'terverifikasi', 'diterima', 'ditolak'])) return redirect()->route('dashboard');

        $orangtua = OrangTuaSiswa::where('pendaftaran_id', $pendaftaran->id)->first();
        $uploadedBerkas = Berkas::with('jenisBerkas')->where('pendaftaran_id', $pendaftaran->id)->get();
        $jenisBerkas = \App\Models\JenisBerkas::where('is_active', true)->get();
        $jurusan = Jurusan::find($pendaftaran->jurusan_id);

        return view('pendaftaran.create', [
            'step' => 4,
            'pendaftaran' => $pendaftaran,
            'orangtua' => $orangtua,
            'uploadedBerkas' => $uploadedBerkas,
            'jenisBerkas' => $jenisBerkas,
            'jurusan' => $jurusan,
             'jurusans' => []
        ]);
    }

    public function submit()
    {
        $user = Auth::user();
        $pendaftaran = Pendaftaran::where('user_id', $user->id)->first();

        if (!$pendaftaran) return redirect()->route('pendaftaran.step1');

        // Periksa dokumen yang wajib
        $uploadedJenisIds = \App\Models\Berkas::where('pendaftaran_id', $pendaftaran->id)
                               ->pluck('jenis_berkas_id')
                               ->toArray();
        
        $wajibBerkas = \App\Models\JenisBerkas::where('is_active', true)
                            ->where('is_wajib', true)
                            ->get();
        
        $missing = [];
        foreach ($wajibBerkas as $jb) {
            if (!in_array($jb->id, $uploadedJenisIds)) {
                $missing[] = $jb->nama_berkas;
            }
        }

        if (!empty($missing)) {
             $missingStr = implode(', ', $missing);
             return redirect()->route('pendaftaran.step3')->with('error', 'Harap upload berkas wajib berikut: ' . $missingStr);
        }

        $pendaftaran->update([
            'status' => 'submitted',
            'current_step' => 4
        ]);

        return redirect()->route('dashboard')->with('success', 'Pendaftaran berhasil dikirim! Silahkan pantau status pendaftaran di dashboard.');
    }

    public function success()
    {
        $user = Auth::user();
        $pendaftaran = Pendaftaran::where('user_id', $user->id)->firstOrFail();
        $jurusan = Jurusan::find($pendaftaran->jurusan_id);
        $orangtua = OrangTuaSiswa::where('pendaftaran_id', $pendaftaran->id)->first();

        return view('pendaftaran.cetak', [
            'pendaftaran' => $pendaftaran,
            'jurusan' => $jurusan,
            'orangtua' => $orangtua
        ]);
    }
}
