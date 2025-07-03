<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Admin;
use Throwable;

class AdminLoginController extends Controller
{
    public function showLoginForm()
    {
        if (auth('admin')->check()) {
            return redirect('/dashboard');
        }

        \Log::info('Form login admin diakses');
        return view('auth.admin-login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'id_admin' => 'required|string',
            'password' => 'required|string',
        ]);

        try {
            $credentials = $request->only('id_admin', 'password');

            if (Auth::guard('admin')->attempt($credentials)) {
                $admin = Auth::guard('admin')->user();
                Log::info('Login admin berhasil', ['id_admin' => $admin->id_admin]);
                return redirect()->intended('/dashboard')->with('success', 'Selamat datang, ' . $admin->nama_admin . '!');
            }

            Log::warning('Gagal login admin - ID/password salah', [
                'id_admin_input' => $request->id_admin
            ]);

            return back()->withErrors(['login_error' => 'ID atau password salah.']);

        } catch (Throwable $e) {
            Log::error('Error saat proses login admin', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return back()->withErrors(['login_error' => 'Terjadi kesalahan saat login. Silakan coba lagi.']);
        }
    }

    public function logout(Request $request)
    {
        try {
            $adminId = Auth::guard('admin')->check() ? Auth::guard('admin')->user()->id_admin : null;
            Auth::guard('admin')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            Log::info('Admin logout', ['id_admin' => $adminId]);

            return redirect('/login')->with('success', 'Anda berhasil logout.');
        } catch (Throwable $e) {
            Log::error('Error saat logout admin', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect('/login')->with('error', 'Terjadi kesalahan saat logout.');
        }
    }
}
