<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class AdminCalonSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Eager load relationships to avoid N+1 problem
        $pendaftar = Pendaftaran::with(['user', 'jurusan', 'gelombang'])
            ->latest()
            ->paginate(10);

        return view('admin.calon-siswa.index', compact('pendaftar'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jurusans = \App\Models\Jurusan::aktif()->get();
        $gelombangs = \App\Models\Gelombang::all();
        $jenisBerkas = \App\Models\JenisBerkas::where('is_active', true)->get();

        return view('admin.calon-siswa.create', compact('jurusans', 'gelombangs', 'jenisBerkas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            // User validation
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',

            // Pendaftaran validation
            'nama_lengkap' => 'required|string|max:50',
            'nisn' => 'required|string|max:10|unique:pendaftaran,nisn',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'required|string|max:50',
            'tanggal_lahir' => 'required|date',
            'golongan_darah' => 'nullable|string|max:2',
            'agama' => 'required|string|max:20',
            'alamat_rumah' => 'required|string|max:255',
            'nomor_hp' => 'required|string|max:15',
            'asal_sekolah' => 'required|string|max:100',
            'jurusan_id' => 'required|exists:jurusan,id',
            'gelombang_id' => 'required|exists:gelombangs,id',
            'status' => 'required|in:draft,menunggu_verifikasi,terverifikasi,diterima,ditolak',

            // OrangTua validation
            'nama_ayah' => 'required|string|max:100',
            'pekerjaan_ayah' => 'required|string|max:50',
            'penghasilan_ayah' => 'required|numeric|min:0',
            'nama_ibu' => 'required|string|max:100',
            'pekerjaan_ibu' => 'required|string|max:50',
            'penghasilan_ibu' => 'required|numeric|min:0',
            'no_hp_orangtua' => 'required|string|max:20',
        ]);

        \Illuminate\Support\Facades\DB::transaction(function () use ($request) {
            // 1. Create User
            $user = \App\Models\User::create([
                'name' => $request->nama_lengkap,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => 'calon_siswa',
            ]);

            // 2. Create Pendaftaran
            $calonSiswa = Pendaftaran::create([
                'user_id' => $user->id,
                'nama_lengkap' => $request->nama_lengkap,
                'nisn' => $request->nisn,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'golongan_darah' => $request->golongan_darah,
                'agama' => $request->agama,
                'alamat_rumah' => $request->alamat_rumah,
                'nomor_hp' => $request->nomor_hp,
                'asal_sekolah' => $request->asal_sekolah,
                'jurusan_id' => $request->jurusan_id,
                'gelombang_id' => $request->gelombang_id,
                'status' => $request->status,
                'tanggal_daftar' => now(),
            ]);

            // 3. Create Orang Tua
            $calonSiswa->orangTua()->create([
                'nama_ayah' => $request->nama_ayah,
                'pekerjaan_ayah' => $request->pekerjaan_ayah,
                'penghasilan_ayah' => $request->penghasilan_ayah,
                'nama_ibu' => $request->nama_ibu,
                'pekerjaan_ibu' => $request->pekerjaan_ibu,
                'penghasilan_ibu' => $request->penghasilan_ibu,
                'no_hp_orangtua' => $request->no_hp_orangtua,
            ]);

            // 4. Upload Berkas
            $jenisBerkas = \App\Models\JenisBerkas::where('is_active', true)->get();
            foreach ($jenisBerkas as $jb) {
                if ($request->hasFile('berkas_' . $jb->id)) {
                    $file = $request->file('berkas_' . $jb->id);
                    $path = $file->store('berkas/' . $calonSiswa->nisn, 'public');
                    
                    \App\Models\Berkas::create([
                        'pendaftaran_id' => $calonSiswa->id,
                        'jenis_berkas_id' => $jb->id,
                        'file_path' => $path,
                        'status_verifikasi' => 'pending', // Default status
                        'uploaded_at' => now(),
                    ]);
                }
            }
        });

        return redirect()->route('admin.calon-siswa.index')->with('success', 'Calon siswa baru berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $calonSiswa = Pendaftaran::with(['user', 'jurusan', 'gelombang', 'orangTua', 'berkas.jenisBerkas'])
            ->findOrFail($id);
            
        return view('admin.calon-siswa.show', compact('calonSiswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $calonSiswa = Pendaftaran::with(['orangTua', 'jurusan', 'gelombang'])
            ->findOrFail($id);
        
        // Load data for dropdowns if needed (e.g. Jurusan, Gelombang)
        // Assuming models exist and are imported
        $jurusans = \App\Models\Jurusan::all();
        $gelombangs = \App\Models\Gelombang::all();

        return view('admin.calon-siswa.edit', compact('calonSiswa', 'jurusans', 'gelombangs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $calonSiswa = Pendaftaran::with('user')->findOrFail($id);
        $user = $calonSiswa->user;

        $request->validate([
            // User validation
            'email' => 'required|email|max:255|unique:users,email,' . ($user ? $user->id : 'NULL'),
            'password' => 'nullable|string|min:8',

            // Pendaftaran validation
            'nama_lengkap' => 'required|string|max:50',
            'nisn' => 'required|string|max:10|unique:pendaftaran,nisn,'.$id,
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'required|string|max:50',
            'tanggal_lahir' => 'required|date',
            'golongan_darah' => 'nullable|string|max:2',
            'agama' => 'required|string|max:20',
            'alamat_rumah' => 'required|string|max:255',
            'nomor_hp' => 'required|string|max:15',
            'asal_sekolah' => 'required|string|max:100',
            'jurusan_id' => 'required|exists:jurusan,id',
            'gelombang_id' => 'required|exists:gelombangs,id',
            'status' => 'required|in:draft,menunggu_verifikasi,terverifikasi,diterima,ditolak',

            // OrangTua validation
            'nama_ayah' => 'required|string|max:100',
            'pekerjaan_ayah' => 'required|string|max:50',
            'penghasilan_ayah' => 'required|numeric|min:0',
            'nama_ibu' => 'required|string|max:100',
            'pekerjaan_ibu' => 'required|string|max:50',
            'penghasilan_ibu' => 'required|numeric|min:0',
            'no_hp_orangtua' => 'required|string|max:20',
        ]);

        // Update User Account
        if ($user) {
            $userData = ['email' => $request->email];
            if ($request->filled('password')) {
                $userData['password'] = bcrypt($request->password);
            }
            $user->update($userData);
        }

        // Update Pendaftaran
        $calonSiswa->update([
            'nama_lengkap' => $request->nama_lengkap,
            'nisn' => $request->nisn,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'golongan_darah' => $request->golongan_darah,
            'agama' => $request->agama,
            'alamat_rumah' => $request->alamat_rumah,
            'nomor_hp' => $request->nomor_hp,
            'asal_sekolah' => $request->asal_sekolah,
            'jurusan_id' => $request->jurusan_id,
            'gelombang_id' => $request->gelombang_id,
            'status' => $request->status,
        ]);

        // Update Orang Tua
        $calonSiswa->orangTua()->updateOrCreate(
            ['pendaftaran_id' => $calonSiswa->id],
            [
                'nama_ayah' => $request->nama_ayah,
                'pekerjaan_ayah' => $request->pekerjaan_ayah,
                'penghasilan_ayah' => $request->penghasilan_ayah,
                'nama_ibu' => $request->nama_ibu,
                'pekerjaan_ibu' => $request->pekerjaan_ibu,
                'penghasilan_ibu' => $request->penghasilan_ibu,
                'no_hp_orangtua' => $request->no_hp_orangtua,
            ]
        );

        return redirect()->route('admin.calon-siswa.index')->with('success', 'Data calon siswa dan akun pengguna berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $calonSiswa = Pendaftaran::with('user')->findOrFail($id);
        $user = $calonSiswa->user;
        
        // Delete related data if cascade delete is not set in database
        // $calonSiswa->orangTua()->delete();
        // $calonSiswa->berkas()->delete();
        
        $calonSiswa->delete();

        // Delete associated user account
        if ($user) {
            $user->delete();
        }

        return redirect()->route('admin.calon-siswa.index')->with('success', 'Data calon siswa dan akun pengguna berhasil dihapus.');
    }
}
