<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAuth
{
    public function handle($request, Closure $next, $role)
    {
        $user = Auth::guard('kader')->user(); // Gunakan guard kader untuk mengambil pengguna yang login
        
        // Periksa peran pengguna berdasarkan guard
        if ($role === 'admin' && !$user->is_admin) {
            abort(403, 'Akses ditolak. Anda bukan admin.');
        }

        if ($role === 'kader' && $user->is_admin) {
            abort(403, 'Akses ditolak. Admin tidak dapat mengakses halaman ini.');
        }

        return $next($request);
    }
}
