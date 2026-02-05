<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class AdminCalonSiswaController extends Controller
{
    /**
     * Menampilkan daftar data calon siswa.
     */
    public function index(Request $request)
    {
        // Memuat relasi tabel secara eager loading untuk menghindari masalah N+1
        $query = Pendaftaran::with(['user', 'jurusan', 'gelombang']);

        if ($request->has('q')) {
            $search = $request->q;
            $query->where(function($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                  ->orWhere('nisn', 'like', "%{$search}%");
            });
        }

        // Filter berdasarkan status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $pendaftar = $query->latest()->paginate(10);

        return view('admin.calon-siswa.index', compact('pendaftar'));
    }

    /**
     * Menampilkan formulir untuk membuat data calon siswa baru.
     */
    public function create()
    {
        $jurusans = \App\Models\Jurusan::aktif()->get();
        $gelombangs = \App\Models\Gelombang::all();
        $jenisBerkas = \App\Models\JenisBerkas::where('is_active', true)->get();

        return view('admin.calon-siswa.create', compact('jurusans', 'gelombangs', 'jenisBerkas'));
    }

    /**
     * Menyimpan data calon siswa baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            // Validasi input data akun pengguna
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',

            // Validasi input data pendaftaran
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
            'ukuran_baju' => 'required|in:S,M,L,XL,XXL,XXXL',
            'jurusan_id' => 'required|exists:jurusan,id',
            'gelombang_id' => 'required|exists:gelombang,id',
            'status' => 'required|in:draft,menunggu_verifikasi,terverifikasi,diterima,ditolak',

            // Validasi input data orang tua
            'nama_ayah' => 'required|string|max:100',
            'pekerjaan_ayah' => 'required|string|max:50',
            'penghasilan_ayah' => 'required|numeric|min:0',
            'nama_ibu' => 'required|string|max:100',
            'pekerjaan_ibu' => 'required|string|max:50',
            'penghasilan_ibu' => 'required|numeric|min:0',
            'no_hp_orangtua' => 'required|string|max:20',
        ]);

        \Illuminate\Support\Facades\DB::transaction(function () use ($request) {
            // 1. Membuat akun pengguna baru
            $user = \App\Models\User::create([
                'name' => $request->nama_lengkap,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => 'calon_siswa',
            ]);

            // 2. Membuat data pendaftaran baru
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
                'ukuran_baju' => $request->ukuran_baju,
                'jurusan_id' => $request->jurusan_id,
                'gelombang_id' => $request->gelombang_id,
                'status' => $request->status,
                'tanggal_daftar' => now(),
            ]);

            // 3. Membuat data orang tua
            $calonSiswa->orangTua()->create([
                'nama_ayah' => $request->nama_ayah,
                'pekerjaan_ayah' => $request->pekerjaan_ayah,
                'penghasilan_ayah' => $request->penghasilan_ayah,
                'nama_ibu' => $request->nama_ibu,
                'pekerjaan_ibu' => $request->pekerjaan_ibu,
                'penghasilan_ibu' => $request->penghasilan_ibu,
                'no_hp_orangtua' => $request->no_hp_orangtua,
            ]);

            // 4. Mengunggah berkas-berkas persyaratan
            $jenisBerkas = \App\Models\JenisBerkas::where('is_active', true)->get();
            foreach ($jenisBerkas as $jb) {
                if ($request->hasFile('berkas_' . $jb->id)) {
                    $file = $request->file('berkas_' . $jb->id);

                    // Memvalidasi ukuran file
                    if ($file->getSize() > 1024 * 1024) { // 1MB in bytes
                        throw \Illuminate\Validation\ValidationException::withMessages([
                           'berkas_' . $jb->id => 'Ukuran berkas ' . $jb->nama_berkas . ' terlalu besar (maksimal 1MB)'
                        ]);
                    }

                    $path = $file->store('berkas/' . $calonSiswa->nisn, 'public');
                    
                    \App\Models\Berkas::create([
                        'pendaftaran_id' => $calonSiswa->id,
                        'jenis_berkas_id' => $jb->id,
                        'file_path' => $path,
                        'status_verifikasi' => 'pending', // Status default
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
     * Menampilkan detail data calon siswa.
     */
    public function show(string $id)
    {
        $calonSiswa = Pendaftaran::with(['user', 'jurusan', 'gelombang', 'orangTua', 'berkas.jenisBerkas'])
            ->findOrFail($id);
            
        return view('admin.calon-siswa.show', compact('calonSiswa'));
    }

    /**
     * Menampilkan formulir untuk mengedit data calon siswa.
     */
    public function edit(string $id)
    {
        $calonSiswa = Pendaftaran::with(['orangTua', 'jurusan', 'gelombang'])
            ->findOrFail($id);
        
        // Memuat data untuk dropdown (contoh: Jurusan, Gelombang)
        // Diasumsikan model sudah ada dan diimport
        $jurusans = \App\Models\Jurusan::all();
        $gelombangs = \App\Models\Gelombang::all();

        return view('admin.calon-siswa.edit', compact('calonSiswa', 'jurusans', 'gelombangs'));
    }

    /**
     * Memperbaharui data calon siswa di database.
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
            'ukuran_baju' => 'required|in:S,M,L,XL,XXL,XXXL',
            'jurusan_id' => 'required|exists:jurusan,id',
            'gelombang_id' => 'required|exists:gelombang,id',
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

        // Memperbaharui data akun pengguna
        if ($user) {
            $userData = ['email' => $request->email];
            if ($request->filled('password')) {
                $userData['password'] = bcrypt($request->password);
            }
            $user->update($userData);
        }

        // Memperbaharui data pendaftaran
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
            'ukuran_baju' => $request->ukuran_baju,
            'jurusan_id' => $request->jurusan_id,
            'gelombang_id' => $request->gelombang_id,
            'status' => $request->status,
        ]);

        // Memperbaharui data orang tua
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
     * Menghapus data calon siswa dari database.
     */
    public function destroy(string $id)
    {
        $calonSiswa = Pendaftaran::with('user')->findOrFail($id);
        $user = $calonSiswa->user;
        
        // Menghapus data terkait jika on delete cascade tidak diatur di database
        // $calonSiswa->orangTua()->delete();
        // $calonSiswa->berkas()->delete();
        
        $calonSiswa->delete();

        // Menghapus akun pengguna yang terkait
        if ($user) {
            $user->delete();
        }

        return redirect()->route('admin.calon-siswa.index')->with('success', 'Data calon siswa dan akun pengguna berhasil dihapus.');
    }
}
