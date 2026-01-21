<?php

namespace App\Http\Controllers;

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
     * Entry point for PPDB Registration.
     * Determines which step to show based on user's progress.
     */
    public function index()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }

        // Check if pendaftaran exists
        $pendaftaran = Pendaftaran::where('user_id', $user->id)->first();

        if (!$pendaftaran) {
            // Check for active PPDB Gelombang
            $activePeriod = Gelombang::where('is_active', true)
                ->whereDate('tanggal_mulai', '<=', now())
                ->whereDate('tanggal_selesai', '>=', now())
                ->first();
            if (!$activePeriod) {
                return redirect()->back()->with('error', 'Tidak ada gelombang PPDB yang aktif saat ini.');
            }

            // Create Draft Pendaftaran
            // Default jurusan_id 1 if not selected yet (will be updated in Step 1) -> schema makes it required so we might need nullable or default.
            // Looking at schema: id, user_id, periodeppdb_id, jurusan_id are required.
            // We can't insert incomplete data easily if schema prevents it.
            // Strategy: Redirect to Step 1 Form, and do the "Insert Awal" ONLY when Step 1 is submitted.
            // BUT diagram says: "Data pendaftaran sudah ada? (Tidak) -> Buat data pendaftaran (Insert awal: status=draft, current_step=0)".
            // If the schema requires jurusan_id immediately, we might have a problem if we insert before user picks it.
            // Let's assume we can pick a default or modify schema (too risky).
            // BETTER: Proceed to Step 1 view, but don't insert record until Step 1 submit.
            // Actually the diagram says "Insert awal" then "Redirect ke step (current_step + 1)". 0+1 = 1.
            // So if I don't insert, I just show Step 1.
            
            return redirect()->route('pendaftaran.step1');
        }

        if (in_array($pendaftaran->status, ['submitted', 'terverifikasi', 'diterima', 'ditolak'])) {
            return redirect()->route('dashboard');
        }

        // Redirect to appropriate step
        $step = $pendaftaran->current_step + 1;
        
        // Safety bound
        if ($step < 1) $step = 1;
        if ($step > 4) $step = 4;

        return redirect()->route('pendaftaran.step' . $step);
    }

    // STEP 1: Biodata
    public function step1()
    {
        $user = Auth::user();
        $pendaftaran = Pendaftaran::where('user_id', $user->id)->first();
        
        if ($pendaftaran && in_array($pendaftaran->status, ['submitted', 'terverifikasi', 'diterima', 'ditolak'])) {
             return redirect()->route('dashboard');
        }

        $jurusans = Jurusan::where('status', 'aktif')->get();
        // Return view with step 1 data
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
        
        // Validate
        $validator = Validator::make($request->all(), [
            'nama_lengkap' => 'required|string|max:50',
            'nisn' => ['required', 'digits:10', 'unique:pendaftaran,nisn,' . ($pendaftaran->id ?? 'NULL')],
            'tempat_lahir' => 'required|string|max:50',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'required|string',
            'jurusan_id' => 'required|exists:jurusan,id',
            'nomor_hp' => 'required|string|max:15|regex:/^[0-9]+$/',
            'asal_sekolah' => 'required|string|max:100',
            'alamat_rumah' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Get Active Gelombang
        $activePeriod = Gelombang::where('is_active', true)
            ->whereDate('tanggal_mulai', '<=', now())
            ->whereDate('tanggal_selesai', '>=', now())
            ->first();
        if (!$activePeriod) {
            return redirect()->back()->with('error', 'Tidak ada gelombang PPDB yang aktif.');
        }

        // Create or Update
        // Note: $pendaftaran already fetched above

        // Generate Registration Number if new
        $no_pendaftaran = $pendaftaran ? $pendaftaran->no_pendaftaran : 'REG-' . time() . '-' . rand(100,999);

        // Prepare data
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

    // STEP 2: Data Orang Tua
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
             // pass null jurusans to avoid error in view partials if shared
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

    // STEP 3: Upload Berkas
    public function step3()
    {
        $user = Auth::user();
        $pendaftaran = Pendaftaran::where('user_id', $user->id)->first();

        if (!$pendaftaran) return redirect()->route('pendaftaran.step1');
        if (in_array($pendaftaran->status, ['submitted', 'terverifikasi', 'diterima', 'ditolak'])) return redirect()->route('dashboard');
        
        // Get existing files
        $berkas = Berkas::where('pendaftaran_id', $pendaftaran->id)->get();

        return view('pendaftaran.create', [
            'step' => 3,
            'pendaftaran' => $pendaftaran,
            'berkas' => $berkas,
             'jurusans' => []
        ]);
    }

    public function storeStep3(Request $request)
    {
        $user = Auth::user();
        $pendaftaran = Pendaftaran::where('user_id', $user->id)->firstOrFail();

        // Cek berkas wajib: KK dan Akta Kelahiran
        $uploadedFiles = Berkas::where('pendaftaran_id', $pendaftaran->id)
                               ->pluck('tipe_berkas')
                               ->toArray();
        
        $required = ['kk', 'akta_kelahiran'];
        $missing = array_diff($required, $uploadedFiles);

        if (!empty($missing)) {
             $missingStr = implode(', ', array_map(function($item) {
                 return strtoupper(str_replace('_', ' ', $item));
             }, $missing));
             
             return redirect()->back()->with('error', 'Harap upload berkas wajib berikut: ' . $missingStr);
        }

        $pendaftaran->update(['current_step' => 3]);

        return redirect()->route('pendaftaran.step4');
    }

    public function uploadBerkas(Request $request)
    {
         $request->validate([
            'file' => 'required|file|max:2048|mimes:jpg,jpeg,png,pdf',
            'tipe_berkas' => 'required|string'
        ]);

        $user = Auth::user();
        $pendaftaran = Pendaftaran::where('user_id', $user->id)->firstOrFail();
        
        $file = $request->file('file');
        $type = $request->tipe_berkas;
        
        $path = $file->store('berkas_' . $pendaftaran->id, 'public');
        
        $berkas = Berkas::updateOrCreate(
            [
                'pendaftaran_id' => $pendaftaran->id, 
                'tipe_berkas' => $type
            ],
            [
                'path_berkas' => $path,
                'status_verifikasi' => 'pending',
                'is_active' => true,
                'tanggal_verifikasi' => null
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Berkas berhasil diupload',
            'url' => asset('storage/' . $path)
        ]);
    }

    // STEP 4: Konfirmasi
    public function step4()
    {
        $user = Auth::user();
        $pendaftaran = Pendaftaran::where('user_id', $user->id)->first();

        if (!$pendaftaran) return redirect()->route('pendaftaran.step1');
        if (in_array($pendaftaran->status, ['submitted', 'terverifikasi', 'diterima', 'ditolak'])) return redirect()->route('dashboard');

        $orangtua = OrangTuaSiswa::where('pendaftaran_id', $pendaftaran->id)->first();
        $berkas = Berkas::where('pendaftaran_id', $pendaftaran->id)->get();
        $jurusan = Jurusan::find($pendaftaran->jurusan_id);

        return view('pendaftaran.create', [
            'step' => 4,
            'pendaftaran' => $pendaftaran,
            'orangtua' => $orangtua,
            'berkas' => $berkas,
            'jurusan' => $jurusan,
             'jurusans' => []
        ]);
    }

    public function submit()
    {
        $user = Auth::user();
        $pendaftaran = Pendaftaran::where('user_id', $user->id)->first();

        if (!$pendaftaran) return redirect()->route('pendaftaran.step1');

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
