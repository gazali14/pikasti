<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Kehadiran;
use Illuminate\Http\Request;
use App\Models\KehadiranKader;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AdminKelolaJadwalController extends Controller
{
    public function index(Request $request)
    {
        $selectedKader = Auth::guard('kader')->user();
        $search = $request->input('search');
        $jadwals = Jadwal::query()
            ->when($search, function ($query) use ($search) {
                $query->where('nama_kegiatan', 'LIKE', "%{$search}%");
            })
            ->orderBy('tanggal', 'desc')
            ->orderBy('waktu', 'desc')
            ->paginate(5);

        return view('admin.kelola_jadwal', compact('jadwals', 'selectedKader'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'nama_kegiatan' => 'required|string|max:255',
                'tanggal' => 'required|date',
                'waktu' => 'required|date_format:H:i',
            ]);

            // Format tanggal ke Y-m-d agar hanya tanggal yang disimpan
            $validated['tanggal'] = Carbon::parse($validated['tanggal'])->format('Y-m-d');

            Jadwal::create($validated);
            return redirect()->route('kelola_jadwal.index')->with('success', 'Jadwal berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'nama_kegiatan' => 'required|string|max:255',
                'tanggal' => 'required|date',
                'waktu' => 'required|date_format:H:i',
            ]);

            $jadwal = Jadwal::findOrFail($id);


            $jadwal->update([
                'nama_kegiatan' => $validated['nama_kegiatan'],
                'tanggal' => $validated['tanggal'],
                'waktu' => $validated['waktu'],
            ]);

            return redirect()->route('kelola_jadwal.index')->with('success', 'Jadwal berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $jadwal = jadwal::findOrFail($id);

            $jadwal->delete();

            return redirect()->route('kelola_jadwal.index')->with('success', 'Dokumentasi berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $jadwal = Jadwal::findOrFail($id);
            return response()->json($jadwal);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }
}
