<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class EnsureAppInstalled
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Don't intercept API routes or assets usually, but simpler check:
        // If route is already install related, allow it
        if ($request->is('install*')) {
             // Block access to install page if users actully exist
             if (User::count() > 0) {
                 return redirect('/');
             }
             return $next($request);
        }

        // For all other routes, if no user exists, redirect to install
        try {
            if (User::count() === 0) {
                return redirect()->route('install.index');
            }
        } catch (\Exception $e) {
            // Failsafe if DB not migrated yet, just allow trough to error or generic page
            // But realistically 500 is fine if DB missing.
        }

        return $next($request);
    }
}
