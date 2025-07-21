<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleRedirectMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Ambil pengguna yang sedang login
        $user = $request->user();

        // Cek peran pengguna dan arahkan ke dashboard yang sesuai
        if ($user) {
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            if ($user->role === 'noc') {
                return redirect()->route('noc.dashboard');
            }
        }

        // Jika bukan admin atau NOC, biarkan mereka mengakses halaman yang dituju (dashboard pelanggan)
        return $next($request);
    }
}