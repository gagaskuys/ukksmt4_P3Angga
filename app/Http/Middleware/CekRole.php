<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CekRole
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Mengecek apakah user sudah login dan kolom role di database cocok
        if ($request->user() && $request->user()->role === $role) {
            return $next($request);
        }

        // Jika tidak cocok, lempar error 403 Forbidden
        abort(403, 'USER DOES NOT HAVE THE RIGHT ROLES.');
    }
}
