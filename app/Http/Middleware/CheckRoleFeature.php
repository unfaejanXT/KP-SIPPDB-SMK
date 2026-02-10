<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRoleFeature
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        // Operator Sekolah (Super Admin) - Bisa Akses Semua
        if ($user->hasRole('operator_sekolah')) {
            return $next($request);
        }

        $routeName = $request->route()->getName();

        // Staff PPDB (Panitia PPDB)
        if ($user->hasRole('staff_ppdb')) {
            if ($this->isStaffFeature($routeName)) {
                return $next($request);
            }
        }

        // Kepala Sekolah
        if ($user->hasRole('kepala_sekolah')) {
            if ($this->isKepalaSekolahFeature($routeName)) {
                return $next($request);
            }
        }

        // Default strict for admin routes if role doesn't match allowed features
        if ($request->is('admin/*')) {
            abort(403, 'Anda tidak memiliki akses ke fitur ini.');
        }

        return $next($request);
    }

    private function isStaffFeature($routeName)
    {
        // Staff Features based on user request:
        // - Dashboard
        // - Kelola Data Pendaftaran (calon-siswa)
        // - Verifikasi Berkas Pendaftaran (verifikasi-berkas)
        // - Kelola Periode PPDB
        // - Kelola Gelombang Pendaftaran
        // - Kelola Laporan PPDB

        if ($routeName === 'admin.dashboard') return true;

        // Common things like logout/profile that should likely be allowed
        if (str_starts_with($routeName, 'admin.profile.')) return true; // Assuming they can edit own profile
        
        // Allowed modules
        if (str_starts_with($routeName, 'admin.calon-siswa.')) return true;
        if (str_starts_with($routeName, 'admin.verifikasi.')) return true;
        if (str_starts_with($routeName, 'admin.periode.')) return true;
        if (str_starts_with($routeName, 'admin.gelombang.')) return true;
        if (str_starts_with($routeName, 'admin.laporan.')) return true;

        // Also allow specific user management if it relates to "Data Pendaftaran" but typically 'users' resource is administrative.
        // The user specifically said "Kelola Data Pendaftaran". Typically represented by CalonSiswaController.

        return false;
    }

    private function isKepalaSekolahFeature($routeName)
    {
        // Kepala Sekolah Features:
        // - Dashboard
        // - Kelola Laporan PPDB

        if ($routeName === 'admin.dashboard') return true;
        
        // Common things
        if (str_starts_with($routeName, 'admin.profile.')) return true;

        // Allowed modules
        if (str_starts_with($routeName, 'admin.laporan.')) return true;

        return false;
    }
}
