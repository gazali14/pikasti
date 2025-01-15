<?php

namespace App\Http\Controllers;

use App\Models\KMS;
use App\Models\Bayi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HalamanDashboardOrangTuaController extends Controller
{
    public function index()
    {
        // Ambil bayi yang sedang login
        $selectedBayi = Auth::guard('bayi')->user();

        $bayiList = Bayi::all(); 
        if (!$selectedBayi) {
            return redirect()->route('login')->withErrors(['error' => 'Silakan login terlebih dahulu.']);
        }

        // Ambil data KMS berdasarkan NIK bayi
        $kmsData = KMS::where('nik_bayi', $selectedBayi->nik)
            ->orderBy('tanggal', 'asc')
            ->get()
            ->map(function ($item) use ($selectedBayi) {
                $tanggalLahir = \Carbon\Carbon::parse($selectedBayi->tanggal_lahir);
                $tanggalKMS = \Carbon\Carbon::parse($item->tanggal);
                $item->umur_bulan = $tanggalLahir->diffInMonths($tanggalKMS);
                return $item;
            });

            $selectedBayiNik = $selectedBayi->nik;
            return view('orang_tua.dashboard', compact('bayiList', 'kmsData','selectedBayi', 'selectedBayiNik'));
    }
}
