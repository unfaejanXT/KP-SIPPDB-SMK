<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleRedirect
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();

            // Admin Logic
            if ($user->hasRole('operator_sekolah') || $user->hasRole('staff_ppdb') || $user->hasRole('kepala_sekolah')) {
                // If attempting to access student restricted routes
                if ($request->is('dashboard') || $request->is('dashboard/*') || $request->is('pendaftaran') || $request->is('pendaftaran/*')) {
                    if ($request->expectsJson()) {
                         return response()->json(['message' => 'Unauthorized'], 403);
                    }
                    return redirect()->route('admin.dashboard');
                }
            }
            // Student/User Logic
            elseif ($user->hasRole('calon_siswa')) {
                // If attempting to access admin restricted routes
                if ($request->is('admin') || $request->is('admin/*')) {
                    if ($request->expectsJson()) {
                         return response()->json(['message' => 'Unauthorized'], 403);
                    }
                    return redirect()->route('dashboard');
                }
            }
        }

        return $next($request);
    }
}
