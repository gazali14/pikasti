<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dokumentasi;

class HalamanDokumentasiController extends Controller
{
    public function index()
    {
        // Ambil data dokumentasi dari database
        $dokumentasis = Dokumentasi::orderBy('tanggal', 'desc')->get();

        // Kirim data ke view
        return view('orang_tua/before_login/dokumentasi', compact('dokumentasis'));
    }
}

