<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use App\Models\User;
use App\Models\Jurusan;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;
use App\Models\Gelombang;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Mencegah pengguna umum mengakses jika tidak memiliki izin
        if (Auth::check() && Auth::user()->hasRole('calon_siswa')) {
            abort(403, 'Unauthorized action.');
        }

        // --- Statistik Utama ---
        $totalPendaftar = Pendaftaran::count();
        
        // Menormalisasi pengecekan status untuk menangani sensitivitas huruf besar/kecil
        $menungguVerifikasi = Pendaftaran::whereIn(DB::raw('LOWER(status)'), ['menunggu_verifikasi', 'menunggu', 'draft', 'submitted', 'pending'])->count();
        $terverifikasi = Pendaftaran::whereIn(DB::raw('LOWER(status)'), ['terverifikasi', 'diterima'])->count();
        $ditolak = Pendaftaran::where(DB::raw('LOWER(status)'), 'ditolak')->count();

        $jumlahJurusan = Jurusan::count();
        $totalUser = User::count();

        // --- Gelombang Aktif ---
        $activeGelombang = Gelombang::where('is_active', true)
            ->whereDate('tanggal_mulai', '<=', now())
            ->whereDate('tanggal_selesai', '>=', now())
            ->first();
            
        // Fallback jika tidak ada flag aktif spesifik, hanya memeriksa tanggal
        if (!$activeGelombang) {
            $activeGelombang = Gelombang::whereDate('tanggal_mulai', '<=', now())
                ->whereDate('tanggal_selesai', '>=', now())
                ->first();
        }

        // --- Data Grafik: Tren Pendaftaran (7 Hari Terakhir) ---
        $period = \Carbon\CarbonPeriod::create(now()->subDays(6), now());
        $dates = [];
        $counts = [];

        // Isi awal dengan 0
        foreach ($period as $date) {
            $dates[$date->format('Y-m-d')] = 0;
        }

        // Ambil data sebenarnya
        $registrations = Pendaftaran::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->whereDate('created_at', '>=', now()->subDays(6))
            ->groupBy('date')
            ->get()
            ->pluck('count', 'date')
            ->toArray();

        // Menggabungkan data
        foreach ($registrations as $date => $count) {
            if (isset($dates[$date])) {
                $dates[$date] = $count;
            }
        }
        
        $chartLabels = array_keys($dates);
        // Format label untuk JS (contoh: "24 Jan")
        $formattedLabels = array_map(function($date) {
            return \Carbon\Carbon::parse($date)->format('d M');
        }, $chartLabels);
        $chartValues = array_values($dates);


        // --- Data Grafik: Distribusi Jurusan ---
        $jurusanStats = Pendaftaran::select('jurusan_id', DB::raw('count(*) as count'))
            ->groupBy('jurusan_id')
            ->with(['jurusan' => function($query) {
                $query->select('id', 'nama'); // Optimasi pengambilan data
            }])
            ->get();

        $jurusanLabels = [];
        $jurusanValues = [];
        
        // Jika tidak ada data, sediakan struktur kosong atau tangani di view
        if ($jurusanStats->count() > 0) {
            foreach($jurusanStats as $stat) {
                // Gunakan aksesor atau atribut mentah. Aksesor adalah 'nama_jurusan', mentah adalah 'nama'.
                // Jika menggunakan 'nama_jurusan' (aksesor), bergantung pada 'nama' yang dimuat.
                $jurusanLabels[] = $stat->jurusan->nama ?? 'Jurusan #' . $stat->jurusan_id;
                $jurusanValues[] = $stat->count;
            }
        } else {
            // Ambil semua nama jurusan untuk konteks grafik kosong
            $allJurusan = Jurusan::pluck('nama');
            $jurusanLabels = $allJurusan->toArray();
            $jurusanValues = array_fill(0, count($jurusanLabels), 0);
        }


        // --- Pendaftaran Terbaru ---
        $latestPendaftar = Pendaftaran::with(['jurusan', 'gelombang']) // Muat gelombang secara eager loading jika diperlukan
                                      ->orderBy('created_at', 'desc')
                                      ->take(5)
                                      ->get();

        return view('admin.dashboard', compact(
            'totalPendaftar',
            'menungguVerifikasi',
            'terverifikasi',
            'ditolak',
            'jumlahJurusan',
            'totalUser',
            'latestPendaftar',
            'activeGelombang',
            'formattedLabels',
            'chartValues',
            'jurusanLabels',
            'jurusanValues'
        ));
    }
}

