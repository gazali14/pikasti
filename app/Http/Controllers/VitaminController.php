<?php

namespace App\Http\Controllers;

use App\Models\Vitamin;
use App\Models\Bayi;
use Illuminate\Http\Request;
use App\Models\Jadwal;
use Carbon\Carbon;


class VitaminController extends Controller
{

    public function index(Request $request)
    {
        $jadwals = Jadwal::all()->map(function ($jadwal) {
            $jadwal->formatted_date = Carbon::parse($jadwal->tanggal)->translatedFormat('d F Y');
            return $jadwal;
        });

        $tanggal = $request->input('tanggal');
        $bayis = Bayi::with(['vitamins.jadwal'])->get();

        $bayis = $bayis->map(function ($bayi) use ($tanggal) {
            if ($tanggal) {
                $bayi->vitamins = $bayi->vitamins->filter(function ($vitamin) use ($tanggal) {
                    return $vitamin->jadwal && Carbon::parse($vitamin->jadwal->tanggal)->format('Y-m-d') === $tanggal;
                });
            }

            if ($bayi->vitamins->isEmpty()) {
                $bayi->vitamins = collect([
                    (object)[
                        'vitamin' => 'Tidak ada data vitamin',
                        'jadwal' => (object)['nama_kegiatan' => 'Tidak ada data kegiatan']
                    ]
                ]);
            }

            return $bayi;
        });

        return view('kader.vitamin', compact('bayis', 'jadwals', 'tanggal'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jenis_vitamin' => 'required|string',
            'id_kegiatan' => 'required|integer|exists:jadwals,id',
        ]);

        $bayi = Bayi::firstOrCreate(['nama' => $validated['nama']]);

        $existingVitamin = Vitamin::where('id_bayi', $bayi->id)
            ->where('id_kegiatan', $validated['id_kegiatan'])
            ->first();

        if ($existingVitamin) {
            $existingVitamin->update([
                'vitamin' => $validated['jenis_vitamin'],
            ]);
        } else {
            Vitamin::create([
                'id_bayi' => $bayi->id,
                'nama_bayi' => $bayi->nama,
                'vitamin' => $validated['jenis_vitamin'],
                'id_kegiatan' => $validated['id_kegiatan'],
            ]);
        }

        return redirect()->route('kader.vitamin.index')->with('success', 'Data vitamin berhasil disimpan atau diperbarui.');
    }

    public function destroy(Request $request)
    {
        $validated = $request->validate([
            'id_kegiatan' => 'required|integer',
            'id_bayi' => 'required|integer',
        ]);

        $deleted = Vitamin::where('id_bayi', $validated['id_bayi'])
            ->where('id_kegiatan', $validated['id_kegiatan'])
            ->delete();

        if ($deleted) {
            return response()->json(['success' => true, 'message' => 'Data berhasil dihapus.']);
        } else {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan.']);
        }
    }
}
