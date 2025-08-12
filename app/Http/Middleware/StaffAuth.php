<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class StaffAuth
 *
 * Middleware ini digunakan untuk memastikan bahwa hanya user yang sudah login
 * (authenticated) yang dapat mengakses route tertentu pada staff portal.
 *
 * Jika user belum login, maka akan diarahkan ke halaman login staff.
 *
 * @package App\Http\Middleware
 */
class StaffAuth
{
    /**
     * Menangani request yang masuk.
     *
     * Proses:
     * 1. Mengecek apakah ada user yang sedang login menggunakan Auth::user().
     * 2. Jika tidak ada, redirect ke route 'staff-portal.auth.login'.
     * 3. Jika ada, lanjutkan request ke middleware berikutnya atau ke controller.
     *
     * @param \Illuminate\Http\Request $request Request yang masuk dari client.
     * @param \Closure $next Closure untuk meneruskan request ke proses selanjutnya.
     *
     * @return \Symfony\Component\HttpFoundation\Response Response HTTP.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if (!$user) {
            return response()->redirectToRoute('staff-portal.auth.login');
        }

        return $next($request);
    }
}
