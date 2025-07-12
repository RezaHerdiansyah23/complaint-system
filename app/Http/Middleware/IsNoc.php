<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsNoc
{
     public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->role === 'noc') {
            return $next($request);
        }

        abort(403, 'Unauthorized access.'); // atau bisa redirect ke halaman lain
    }
}
