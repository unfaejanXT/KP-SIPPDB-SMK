<?php

namespace App\Http\Controllers;

use App\Models\Berkas;
use App\Models\OrangTuaSiswa;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    public function index(){

    }

    public function pendaftaran(){
        return view('public.register');
    }

    public function store(Request $request){
        $validasiFormulir = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nisn' => 'required|numeric|digits:10',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'agama' => 'required|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu',
            'golongan_darah' => 'required|in:A,B,AB,O',
            'alamat_rumah' => 'required|string|max:255',
            'rumah_milik' => 'required|in:Sendiri,Kontrak/Sewa,Keluarga',
            'telepon_rumah' => 'required|string|max:15',
            'nomor_hp' => 'required|string|max:15',
            'asal_sekolah' => 'required|string|max:255',
            'nama_ayah' => 'required|string|max:255',
            'pekerjaan_ayah' => 'required|string|max:255',
            'nama_ibu' => 'required|string|max:255',
            'pekerjaan_ibu' => 'required|string|max:255',
            'nama_wali' => 'nullable|string|max:255',
            'nohp_orangtua' => 'required|string|max:15',
            'pekerjaan_wali' => 'nullable|string|max:255',
            'nohp_wali' => 'required|string|max:15',
            'alamat_wali' => 'nullable|string|max:255',
        ]);

        $Berkas = Berkas::create();
        $OrangTuaSiswa = OrangTuaSiswa::create([
            'nama_ayah' => $request->nama_ayah,
            'pekerjaan_ayah' => $request->pekerjaan_ayah,
            'nama_ibu' => $request->nama_ibu,
            'pekerjaan_ibu' => $request->pekerjaan_ibu,
            'nama_wali' => $request->nama_wali,
            'pekerjaan_wali' => $request->pekerjaan_wali,
            'nohp_wali' => $request->nohp_wali,
            'nohp_orangtua' => $request->nohp_orangtua,
        ]);
        
        $pendaftaransiswa = Pendaftaran::create([
            'nisn' => $request->nisn,
            'nama_lengkap' => $request->nama_lengkap,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'golongan_darah' => $request->golongan_darah,
            'agama' => $request->agama,
            'alamat_rumah' => $request->alamat_rumah,
            'nomor_hp' => $request->nomor_hp,
            'asal_sekolah' => $request->asal_sekolah,
            'tanggal_daftar' => now(),
        ]);

        return redirect()->back()->with('success', 'Data berhasil disimpan.');
    }
}
