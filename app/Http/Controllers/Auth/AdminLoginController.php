<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.admin-login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'id_admin' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('id_admin', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            $admin = Auth::guard('admin')->user();
            return redirect()->intended('/pelanggan')->with('success', 'Selamat datang, ' . $admin->nama_admin . '!');
        }

        return back()->withErrors(['login_error' => 'ID atau password salah.']);
    }

    public function logout(Request $request)
    {
        Auth::logout(); // log out
        $request->session()->invalidate(); // hapus session
        $request->session()->regenerateToken(); // keamanan CSRF baru
        return redirect('/login')->with('success', 'Anda berhasil logout.');
    }
}
