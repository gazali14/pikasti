<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;

class JadwalController extends Controller
{
    public function index()
    {
        $jadwals = Jadwal::all();
        return view('jadwal.index', compact('jadwals'));
    }

    // Menampilkan form untuk membuat jadwal baru
    public function create()
    {
        return view('jadwal.create');
    }

    // Menyimpan jadwal baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'waktu' => 'required',
        ]);

        // Mengonversi tanggal menjadi format Y-m-d tanpa waktu
        $validated['tanggal'] = \Carbon\Carbon::parse($validated['tanggal'])->toDateString();

        Jadwal::create($validated);
        dd($request->tanggal); 

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    // Menampilkan jadwal tertentu
    public function show(Jadwal $jadwal)
    {
        return view('jadwal.show', compact('jadwal'));
    }

    // Menampilkan form edit untuk jadwal tertentu
    public function edit(Jadwal $jadwal)
    {
        return view('jadwal.edit', compact('jadwal'));
    }

    // Memperbarui jadwal tertentu
    public function update(Request $request, Jadwal $jadwal)
    {
        $validated = $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'waktu' => 'required',
        ]);

        // Mengonversi tanggal menjadi format Y-m-d tanpa waktu
        $validated['tanggal'] = \Carbon\Carbon::parse($validated['tanggal'])->toDateString();

        $jadwal->update($validated);
        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil diperbarui.');
    }

    // Menghapus jadwal tertentu
    public function destroy(Jadwal $jadwal)
    {
        $jadwal->delete();
        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil dihapus.');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $jadwals = Jadwal::where('nama_kegiatan', 'LIKE', "%{$search}%")
            ->orWhere('tanggal', 'LIKE', "%{$search}%")
            ->get();

        return view('jadwal.index', compact('jadwals', 'search'));
    }
}
