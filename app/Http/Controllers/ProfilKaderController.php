<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kader;

class ProfilKaderController extends Controller
{
    public function index()
    {
        // Ambil semua data kader
        $kaders = Kader::select('nama', 'jabatan', 'foto')->paginate(6);

        // Kirim data kader ke view
        return view('orang_tua.before_login.profil_kader', compact('kaders'));
    }
}