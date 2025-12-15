<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Admin = Dokter Hewan
        if (!auth()->check() || auth()->user()->role !== 'dokter_hewan') {
            abort(403, 'Akses ditolak. Hanya dokter hewan yang dapat mengakses halaman ini.');
        }

        return $next($request);
    }
}

