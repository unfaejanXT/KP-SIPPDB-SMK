<?php

namespace App\Http\Controllers;

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
        // Prevent generic users from accessing if they don't have permission
        if (Auth::check() && Auth::user()->hasRole('calon_siswa')) {
            abort(403, 'Unauthorized action.');
        }

        // --- Core Statistics ---
        $totalPendaftar = Pendaftaran::count();
        
        // Normalize status checks to handle case sensitivity
        $menungguVerifikasi = Pendaftaran::whereIn(DB::raw('LOWER(status)'), ['menunggu_verifikasi', 'menunggu', 'draft', 'submitted', 'pending'])->count();
        $terverifikasi = Pendaftaran::whereIn(DB::raw('LOWER(status)'), ['terverifikasi', 'diterima'])->count();
        $ditolak = Pendaftaran::where(DB::raw('LOWER(status)'), 'ditolak')->count();

        $jumlahJurusan = Jurusan::count();
        $totalUser = User::count();

        // --- Active Gelombang ---
        $activeGelombang = Gelombang::where('is_active', true)
            ->whereDate('tanggal_mulai', '<=', now())
            ->whereDate('tanggal_selesai', '>=', now())
            ->first();
            
        // Fallback if no specific active flag, just check dates
        if (!$activeGelombang) {
            $activeGelombang = Gelombang::whereDate('tanggal_mulai', '<=', now())
                ->whereDate('tanggal_selesai', '>=', now())
                ->first();
        }

        // --- Chart Data: Registrations Trend (Last 7 Days) ---
        $period = \Carbon\CarbonPeriod::create(now()->subDays(6), now());
        $dates = [];
        $counts = [];

        // Pre-fill with 0
        foreach ($period as $date) {
            $dates[$date->format('Y-m-d')] = 0;
        }

        // Fetch actual data
        $registrations = Pendaftaran::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->whereDate('created_at', '>=', now()->subDays(6))
            ->groupBy('date')
            ->get()
            ->pluck('count', 'date')
            ->toArray();

        // Merge data
        foreach ($registrations as $date => $count) {
            if (isset($dates[$date])) {
                $dates[$date] = $count;
            }
        }
        
        $chartLabels = array_keys($dates);
        // Format labels for JS (e.g., "24 Jan")
        $formattedLabels = array_map(function($date) {
            return \Carbon\Carbon::parse($date)->format('d M');
        }, $chartLabels);
        $chartValues = array_values($dates);


        // --- Chart Data: Jurusan Distribution ---
        $jurusanStats = Pendaftaran::select('jurusan_id', DB::raw('count(*) as count'))
            ->groupBy('jurusan_id')
            ->with(['jurusan' => function($query) {
                $query->select('id', 'nama'); // Optimize fetch
            }])
            ->get();

        $jurusanLabels = [];
        $jurusanValues = [];
        
        // If no data, provide empty structure or handle in view
        if ($jurusanStats->count() > 0) {
            foreach($jurusanStats as $stat) {
                // Use the accessor or the raw attribute. Accessor is 'nama_jurusan', raw is 'nama'.
                // If using 'nama_jurusan' (accessor), it relies on 'nama' being loaded.
                $jurusanLabels[] = $stat->jurusan->nama ?? 'Jurusan #' . $stat->jurusan_id;
                $jurusanValues[] = $stat->count;
            }
        } else {
            // Retrieve all jurusan names for empty chart context
            $allJurusan = Jurusan::pluck('nama');
            $jurusanLabels = $allJurusan->toArray();
            $jurusanValues = array_fill(0, count($jurusanLabels), 0);
        }


        // --- Latest Registrations ---
        $latestPendaftar = Pendaftaran::with(['jurusan', 'gelombang']) // Eager load gelombang too if needed
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

