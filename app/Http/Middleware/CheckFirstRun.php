<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class CheckFirstRun
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Allow access to setup routes and static assets to prevent loops/broken pages
        if ($request->is('setup') || $request->is('setup/*') || $request->is('_debugbar/*')) {
             // If users exist, don't allow access to setup (except maybe specific conditions, but standard is redirect home)
             if (User::count() > 0) {
                 return redirect('/');
             }
             return $next($request);
        }

        // If database is empty (no users), redirect to setup
        // Use try-catch to handle potential DB connection issues gracefully (though typically we crash)
        try {
            if (User::count() === 0) {
                return redirect()->route('setup.index');
            }
        } catch (\Exception $e) {
            // If DB is not ready, we can't really do much, maybe let standard error handler catch it
            // or return a "Service Unavailable" response.
            // For now, proceed (which will likely error out later if DB is down)
        }

        return $next($request);
    }
}
