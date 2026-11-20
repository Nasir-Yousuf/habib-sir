<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdminMiddleware
{
    /**
     * Handle an incoming request.
     * Verify user is authenticated and possesses the 'admin' role.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->guest(route('login'))->with('error', 'Please authenticate to access the administration system.');
        }

        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized. Administrative credentials required to access this resource.');
        }

        return $next($request);
    }
}
