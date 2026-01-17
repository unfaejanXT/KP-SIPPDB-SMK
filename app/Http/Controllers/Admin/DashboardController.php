<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berkas;
use App\Models\Pendaftaran;
use App\Models\PeriodePPDB;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
{
    // Menghitung jumlah calon siswa yang mendaftar, diverifikasi, dan belum diverifikasi
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
    $gelombang = $periodeAktif ? $periodeAktif->nama : '-';
    $tanggalMulai = $periodeAktif ? $periodeAktif->tanggal_mulai->format('d M Y') : '-';
    $tanggalSelesai = $periodeAktif ? $periodeAktif->tanggal_selesai->format('d M Y') : '-';

    // Menghitung Total Gelombang berdasarkan tahun angkatan yang sama
    $tahunAjaran = $periodeAktif ? $periodeAktif->tahun_ajaran : null; // Pastikan ada tahun ajaran aktif
    $totalGelombang = PeriodePPDB::where('tahun_ajaran', $tahunAjaran)->count();

    // Menghitung Sisa Gelombang berdasarkan tanggal yang belum terlewati dan tahun angkatan yang sama
    $sisaGelombang = PeriodePPDB::where('tahun_ajaran', $tahunAjaran)
                                ->where('tanggal_mulai', '>', $hariIni)
                                ->count();

    return view('admin.index', compact(
        'totalPendaftar',
        'totalDiverifikasi',
        'totalBelumDiverifikasi',
        'hariIni',
        'statusPendaftaran',
        'gelombang',
        'tanggalMulai',
        'tanggalSelesai',
        'totalGelombang',
        'sisaGelombang'
    ));
}


   public function showprofile(){
    
   }
}
