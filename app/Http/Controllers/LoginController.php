<?php

namespace App\Http\Controllers;

use App\Models\Kader;
use App\Models\Bayi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Tampilan login
    public function index()
    {
        return view('orang_tua.before_login.login'); // Sesuaikan dengan view login Anda
    }

    // Proses login
    public function login_proses(Request $request)
    {
        // Validasi input login
        $request->validate([
            'nik' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('nik', 'password');

        // Login untuk bayi
        if (Auth::guard('bayi')->attempt($credentials)) {
            return redirect()->intended(route('orang_tua.before_login.home'));
        }

        // Login untuk kader/admin
        $kader = Kader::where('nik', $request->nik)->first();
        if (Auth::guard('kader')->attempt($credentials)) {
            $kader = Auth::guard('kader')->user();

            // Cek apakah user adalah admin
            if ($kader->is_admin) {
                // Jika admin, redirect ke dashboard admin
                return redirect()->route('admin.dashboard')->with('success', 'Selamat datang, Admin!');
            }

            // Jika bukan admin, diarahkan ke dashboard kader
            return redirect()->route('kader.dashboard')->with('success', 'Selamat datang, Kader!');
        }

        // Jika login gagal, kembalikan ke halaman login dengan pesan error
        return back()->withErrors(['login' => 'Login gagal. Cek NIK atau password!']);
    }

    // Logout
    public function logout(Request $request)
    {
        // Logout dari semua guard
        Auth::guard('bayi')->logout();
        Auth::guard('kader')->logout();

        // Hapus sesi dan regenerasi token CSRF
        $request->session()->flush();
        $request->session()->regenerateToken();

        // Redirect ke halaman home
        return redirect()->route('orang_tua.before_login.home')->with('success', 'Logout berhasil.');
    }

}
