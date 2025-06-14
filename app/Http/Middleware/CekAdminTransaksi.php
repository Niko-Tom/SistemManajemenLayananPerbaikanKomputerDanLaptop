<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CekAdminTransaksi
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $admin = Auth::guard('admin')->user();

        if (!$admin) {
            return redirect('/login')->withErrors(['login_error' => 'Silakan login terlebih dahulu.']);
        }

        if ($admin->role === 'Admin') {
            return redirect()->route('akses-ditolak');
        }

        return $next($request);
    }
}
