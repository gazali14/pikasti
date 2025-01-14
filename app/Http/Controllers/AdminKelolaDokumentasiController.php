<?php

namespace App\Http\Controllers;

use App\Models\Dokumentasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminKelolaDokumentasiController extends Controller
{
    public function index(Request $request)
    {
        $selectedKader = Auth::guard('kader')->user();
        $search = $request->input('search');
        $dokumentasis = Dokumentasi::query()
            ->when($search, function ($query) use ($search) {
                $query->where('nama_kegiatan', 'LIKE', "%{$search}%");
            })
            ->orderBy('tanggal', 'desc')
            ->paginate(5);

        return view('admin.dokumentasi', compact('dokumentasis', 'selectedKader'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'nama_kegiatan' => 'required|string|max:255',
                'deskripsi' => 'nullable|string',
                'tanggal' => 'required|date',
                'foto.*' => 'required|image|mimes:jpeg,png,jpg|max:2048',
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
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
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
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $dokumentasi = Dokumentasi::findOrFail($id);

            if ($dokumentasi->foto) {
                foreach (json_decode($dokumentasi->foto, true) as $foto) {
                    Storage::disk('public')->delete($foto);
                }
            }

            $dokumentasi->delete();

            return redirect()->route('dokumentasi.index')->with('success', 'Dokumentasi berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $dokumentasi = Dokumentasi::findOrFail($id);
            return response()->json($dokumentasi);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }
}
