<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckLogin 
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Mengecek apakah pengguna sudah login
        if (!Auth::check()) {
            return redirect()->route('login'); // Jika belum login, arahkan ke halaman login
        }

        return $next($request); // Lanjutkan ke proses berikutnya jika sudah login
    }
}
