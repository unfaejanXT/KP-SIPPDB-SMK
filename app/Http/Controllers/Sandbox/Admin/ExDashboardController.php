<?php

namespace App\Http\Controllers\Sandbox\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berkas;
use App\Models\Pendaftaran;
use App\Models\PeriodePPDB;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ExDashboardController extends Controller
{
    public function index(){
         // Menghitung jumlah calon siswa yang mendaftar,Verifikasi, dan belum diverifikasi
         $totalPendaftar = Pendaftaran::count();
         $totalDiverifikasi = Berkas::where('status_verifikasi', 'verified')->count();
         $totalBelumDiverifikasi = Berkas::where('status_verifikasi', '!=', 'verified')->count();

         // Mendapatkan data periode pendaftaran yang aktif berdasarkan tanggal hari ini
        $hariIni = Carbon::now(); // Mendapatkan tanggal dan waktu sekarang
        $periodeAktif = PeriodePPDB::where('tanggal_mulai', '<=', $hariIni)
                                  ->where('tanggal_selesai', '>=', $hariIni)
                                  ->first(); // Mengambil periode yang aktif saat ini

        // Menentukan status pendaftaran berdasarkan periode
        $statusPendaftaran = $periodeAktif ? $periodeAktif->status : 'Tidak ada periode aktif';
        $gelombang = $periodeAktif ? $periodeAktif->nama_periode : '-';
        $tanggalMulai = $periodeAktif ? $periodeAktif->tanggal_mulai->format('d M Y') : '-';
        $tanggalSelesai = $periodeAktif ? $periodeAktif->tanggal_selesai->format('d M Y') : '-';
        
        return view('sandbox.admin.index', compact(
            'totalPendaftar', 
            'totalDiverifikasi', 
            'totalBelumDiverifikasi', 
            'hariIni', 
            'statusPendaftaran', 
            'gelombang', 
            'tanggalMulai', 
            'tanggalSelesai'
        ));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
