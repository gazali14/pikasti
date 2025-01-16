<?php
namespace App\Http\Controllers;
use App\Models\Kader;
use App\Models\Bayi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class LoginController extends Controller
{
    public function index()
    {
        return view('orang_tua.before_login.login'); 
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
        $remember = $request->has('remember');  // Cek apakah checkbox remember me dicentang

        // Login untuk bayi
        if (Auth::guard('bayi')->attempt($credentials)) {
            if ($remember) {
                // Generate token dan simpan dalam cookie
                $token = bin2hex(random_bytes(32));  // Generate token yang cukup panjang dan aman
                Cookie::queue('bayi_remember_token', $token, 60 * 24 * 7); // Cookie berlaku selama 7 hari
            }
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

        // Jika login gagal, kirimkan pesan error ke halaman login
        return back()->withErrors(['login_failed' => 'Login gagal. Cek NIK atau password!']);
    }


// Logout
    public function logout(Request $request)
    {
        // Logout semua guard
        Auth::guard('bayi')->logout();
        Auth::guard('kader')->logout();

        // Hapus cookie jika ada
        Cookie::queue(Cookie::forget('bayi_remember_token'));

        // Hapus sesi dan regenerasi token CSRF
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect ke halaman home
        return redirect()->route('orang_tua.before_login.home')->with('success', 'Logout berhasil.');
    }
}
