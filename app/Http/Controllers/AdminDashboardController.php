<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use App\Models\User;
use App\Models\Jurusan;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Prevent generic users from accessing if they don't have permission
        // Assuming 'calon_siswa' is the role for students.
        // If roles aren't fully seeded, we might rely on the fact that admins likely don't have 'calon_siswa' role.
        if (Auth::check() && Auth::user()->hasRole('calon_siswa')) {
            abort(403, 'Unauthorized action.');
        }

        // Statistics
        $totalPendaftar = Pendaftaran::count();
        
        $menungguVerifikasi = Pendaftaran::whereIn('status', [
            'menunggu_verifikasi', 
            'Menunggu', 
            'menunggu', 
            'draft' // Optional: include draft if considered 'waiting'
        ])->count();
        
        $terverifikasi = Pendaftaran::whereIn('status', [
            'terverifikasi', 
            'Terverifikasi', 
            'diterima',
            'Diterima'
        ])->count();
        
        $ditolak = Pendaftaran::whereIn('status', [
            'ditolak',
            'Ditolak'
        ])->count();

        $jumlahJurusan = Jurusan::count();
        
        // Exclude students from user count if desired, but total user is fine
        $totalUser = User::count();

        // Latest Registrations
        $latestPendaftar = Pendaftaran::with('jurusan')
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
            'latestPendaftar'
        ));
    }
}
