<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CekRole
{
    // Ubah parameter $role jadi ...$roles supaya bisa terima banyak nilai
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Cek apakah user sudah login
        if (!$request->user()) {
            abort(403, 'USER DOES NOT HAVE THE RIGHT ROLES.');
        }

        // Ambil role user yang sedang login
        $userRole = $request->user()->role;

        // PISAHKAN daftar role yang diizinkan (berdasarkan tanda |)
        // Contoh: "admin|guru" jadi array ["admin", "guru"]
        $daftarRole = explode('|', $roles[0]);

        // Cek: Apakah role user ada di dalam daftar yang diizinkan?
        if (in_array($userRole, $daftarRole)) {
            return $next($request); // ✅ Boleh masuk
        }

        // ❌ Tidak cocok
        abort(403, 'USER DOES NOT HAVE THE RIGHT ROLES.');
    }
}