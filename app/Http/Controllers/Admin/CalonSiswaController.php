<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Pendaftaran;
use App\Models\OrangTuaSiswa;
use App\Models\Berkas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class CalonSiswaController extends Controller
{
    public function index()
    {
        // Mengambil semua pendaftaran calon siswa
        $pendaftaran = Pendaftaran::with('user', 'jurusan', 'periodeppdb')->get();
        return view('admin.calonsiswa.index', compact('pendaftaran'));
    }

    public function create()
    {
        // Menampilkan form untuk membuat calon siswa
        $roles = Role::all(); // Menampilkan semua role yang tersedia
        return view('admin.calonsiswa.create', compact('roles'));
    }

    public function store(Request $request)
    {
        // Validasi input form
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|unique:users,username|max:255',
            'nohp' => 'required|string|max:15',
            'password' => 'required|string|min:8|confirmed',
            'nisn' => 'required|string|max:10|unique:pendaftaran,nisn',
            'nama_lengkap' => 'required|string|max:50',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'required|string|max:50',
            'tanggal_lahir' => 'required|date',
            'agama' => 'required|string|max:20',
            'alamat_rumah' => 'required|string|max:255',
            'nomor_hp' => 'required|string|max:15',
            'asal_sekolah' => 'required|string|max:100',
            'role' => 'required|exists:roles,name',
            // Validasi untuk orang tua dan berkas
            'nama_ayah' => 'required|string|max:100',
            'pekerjaan_ayah' => 'required|string|max:50',
            'penghasilan_ayah' => 'required|numeric',
            'nama_ibu' => 'required|string|max:100',
            'pekerjaan_ibu' => 'required|string|max:50',
            'penghasilan_ibu' => 'required|numeric',
            // Verifikasi berkas
            'tipe_berkas' => 'required|string|max:255',
            'path_berkas' => 'required|file|mimes:jpeg,png,pdf|max:10240',
        ]);

        // Tahap 1: Membuat user
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'nohp' => $request->nohp,
            'password' => Hash::make($request->password),
        ]);

        // Assign role ke user
        $role = Role::where('name', $request->role)->first();
        $user->assignRole($role);

        // Tahap 2: Membuat pendaftaran
        $pendaftaran = Pendaftaran::create([
            'nisn' => $request->nisn,
            'nama_lengkap' => $request->nama_lengkap,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'agama' => $request->agama,
            'alamat_rumah' => $request->alamat_rumah,
            'nomor_hp' => $request->nomor_hp,
            'asal_sekolah' => $request->asal_sekolah,
            'user_id' => $user->id,
            // Tambahkan nilai periodeppdb_id dan jurusan_id sesuai data yang ada
            'periodeppdb_id' => $request->periodeppdb_id,
            'jurusan_id' => $request->jurusan_id,
        ]);

        // Tahap 3: Membuat orang tua siswa
        OrangTuaSiswa::create([
            'pendaftaran_id' => $pendaftaran->id,
            'nama_ayah' => $request->nama_ayah,
            'pekerjaan_ayah' => $request->pekerjaan_ayah,
            'penghasilan_ayah' => $request->penghasilan_ayah,
            'nama_ibu' => $request->nama_ibu,
            'pekerjaan_ibu' => $request->pekerjaan_ibu,
            'penghasilan_ibu' => $request->penghasilan_ibu,
            'nama_wali' => $request->nama_wali,
            'pekerjaan_wali' => $request->pekerjaan_wali,
            'penghasilan_wali' => $request->penghasilan_wali,
            'alamat_wali' => $request->alamat_wali,
            'no_hp_wali' => $request->no_hp_wali,
            'no_hp_orangtua' => $request->no_hp_orangtua,
        ]);

        // Tahap 4: Menyimpan berkas
        if ($request->hasFile('path_berkas')) {
            $filePath = $request->file('path_berkas')->store('berkas', 'public');
            Berkas::create([
                'tipe_berkas' => $request->tipe_berkas,
                'path_berkas' => $filePath,
                'status_verifikasi' => 'pending',
                'catatan_verifikasi' => '',
                'tanggal_verifikasi' => now(),
                'is_active' => true,
                'pendaftaran_id' => $pendaftaran->id,
            ]);
        }

        return redirect()->route('admin.calonsiswa.index')->with('success', 'Calon siswa berhasil didaftarkan.');
    }

    public function show($id)
    {
        // Menampilkan detail calon siswa
        $pendaftaran = Pendaftaran::with('user', 'orangTua', 'berkas')->findOrFail($id);
        return view('admin.calonsiswa.show', compact('pendaftaran'));
    }

    public function edit($id)
    {
        // Menampilkan form untuk mengedit calon siswa
        $pendaftaran = Pendaftaran::with('user', 'orangTua', 'berkas')->findOrFail($id);
        $roles = Role::all();
        return view('admin.calonsiswa.edit', compact('pendaftaran', 'roles'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input form
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'nohp' => 'required|string|max:15',
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|exists:roles,name',
            // Validasi untuk orang tua dan berkas
            'nama_ayah' => 'required|string|max:100',
            'pekerjaan_ayah' => 'required|string|max:50',
            'penghasilan_ayah' => 'required|numeric',
            'nama_ibu' => 'required|string|max:100',
            'pekerjaan_ibu' => 'required|string|max:50',
            'penghasilan_ibu' => 'required|numeric',
        ]);

        // Mengambil data pendaftaran yang akan diupdate
        $pendaftaran = Pendaftaran::findOrFail($id);
        $user = $pendaftaran->user;

        // Update data user
        $user->update([
            'name' => $request->name,
            'username' => $request->username,
            'nohp' => $request->nohp,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        // Assign role baru
        $user->syncRoles([$request->role]);

        // Update data pendaftaran
        $pendaftaran->update([
            'nisn' => $request->nisn,
            'nama_lengkap' => $request->nama_lengkap,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'agama' => $request->agama,
            'alamat_rumah' => $request->alamat_rumah,
            'nomor_hp' => $request->nomor_hp,
            'asal_sekolah' => $request->asal_sekolah,
        ]);

        // Update data orang tua siswa
        $pendaftaran->orangTua->update([
            'nama_ayah' => $request->nama_ayah,
            'pekerjaan_ayah' => $request->pekerjaan_ayah,
            'penghasilan_ayah' => $request->penghasilan_ayah,
            'nama_ibu' => $request->nama_ibu,
            'pekerjaan_ibu' => $request->pekerjaan_ibu,
            'penghasilan_ibu' => $request->penghasilan_ibu,
            'nama_wali' => $request->nama_wali,
            'pekerjaan_wali' => $request->pekerjaan_wali,
            'penghasilan_wali' => $request->penghasilan_wali,
            'alamat_wali' => $request->alamat_wali,
            'no_hp_wali' => $request->no_hp_wali,
            'no_hp_orangtua' => $request->no_hp_orangtua,
        ]);

        // Update berkas jika ada perubahan
        if ($request->hasFile('path_berkas')) {
            $filePath = $request->file('path_berkas')->store('berkas', 'public');
            $pendaftaran->berkas->update([
                'tipe_berkas' => $request->tipe_berkas,
                'path_berkas' => $filePath,
                'status_verifikasi' => 'pending',
                'catatan_verifikasi' => '',
                'tanggal_verifikasi' => now(),
            ]);
        }

        return redirect()->route('admin.calonsiswa.index')->with('success', 'Data calon siswa berhasil diperbarui.');
    }

    public function destroy($id)
    {
        // Menghapus calon siswa beserta data terkait
        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->user->delete();
        $pendaftaran->delete();

        return redirect()->route('admin.calonsiswa.index')->with('success', 'Calon siswa berhasil dihapus.');
    }
}
