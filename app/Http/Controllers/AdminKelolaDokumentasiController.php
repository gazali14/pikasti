<?php

namespace App\Http\Controllers;

use App\Models\Dokumentasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminKelolaDokumentasiController extends Controller
{
    public function index()
    {
        // Ambil semua data jadwal dari database
        $dokumentasis = Dokumentasi::all();
        return view('admin.dokumentasi', compact('dokumentasis'));
    }

    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal' => 'required|date',
            'foto.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $fotoPaths = [];
        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $file) {
                $fotoPaths[] = $file->store('img/dokumentasi', 'public');
            }
        }

        Dokumentasi::create([
            'nama_kegiatan' => $validated['nama_kegiatan'],
            'deskripsi' => $validated['deskripsi'],
            'tanggal' => $validated['tanggal'],
            'foto' => json_encode($fotoPaths),
        ]);

        return redirect()->route('dokumentasi.index')->with('success', 'Dokumentasi berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $dokumentasi = Dokumentasi::findOrFail($id);
    
        if ($dokumentasi->foto) {
            foreach (json_decode($dokumentasi->foto, true) as $foto) {
                Storage::disk('public')->delete($foto);
            }
        }
    
        $dokumentasi->delete();
    
        return redirect()->route('dokumentasi.index')->with('success', 'Dokumentasi berhasil dihapus!');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal' => 'required|date',
            'foto.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $dokumentasi = Dokumentasi::findOrFail($id);

        $fotoPaths = [];
        if ($dokumentasi->foto) {
            $fotoPaths = json_decode($dokumentasi->foto);
        }

        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $file) {
                $fotoPaths[] = $file->store('img/dokumentasi', 'public');
            }
        }

        $dokumentasi->update([
            'nama_kegiatan' => $validated['nama_kegiatan'],
            'deskripsi' => $validated['deskripsi'],
            'tanggal' => $validated['tanggal'],
            'foto' => json_encode($fotoPaths),
        ]);

        return redirect()->route('dokumentasi.index')->with('success', 'Dokumentasi berhasil diperbarui!');
    }

    public function search(Request $request)
    {
        $keyword = $request->input('search');
        $dokumentasis = Dokumentasi::where('nama_kegiatan', 'LIKE', "%{$keyword}%")
            ->orWhere('tanggal', 'LIKE', "%{$keyword}%")
            ->get();

        // Kembalikan hasil pencarian ke view
        return view('admin.dokumentasi', compact('dokumentasis'));
    }

    public function edit($id)
    {
        $dokumentasi = Dokumentasi::findOrFail($id);
        return response()->json($dokumentasi); // Kembalikan JSON untuk pengisian data di popup
    }
}
