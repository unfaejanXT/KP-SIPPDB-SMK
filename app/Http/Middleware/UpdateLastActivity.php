<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UpdateLastActivity
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
            
            // Update only if last_login_at is null or older than 1 minute to reduce DB writes
            if (is_null($user->last_login_at) || $user->last_login_at->diffInMinutes(now()) > 1) {
                $user->last_login_at = now();
                $user->last_login_ip = $request->ip();
                $user->save();
            }
        }

        return $next($request);
    }
}
