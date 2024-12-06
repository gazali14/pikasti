<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kader;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class KelolaKaderController extends Controller
{
    // Tampilkan halaman kelola kader
    public function index()
    {
        $kaders = Kader::all();
        return view('admin.kelola_kader', compact('kaders'));
    }

    // Pencarian kader dengan AJAX
    public function search(Request $request)
    {
        $query = $request->input('query');
        $kaders = Kader::where('nama', 'LIKE', "%$query%")
            ->orWhere('jabatan', 'LIKE', "%$query%")
            ->orWhere('alamat', 'LIKE', "%$query%")
            ->get();

        return response()->json($kaders);
    }

    // Tambah kader baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nik' => 'required|numeric|digits:16|unique:kaders,nik',
            'nama' => 'required|string|max:100',
            'alamat' => 'required|string',
            'jabatan' => 'required|string|max:50',
            'password' => 'required|string|min:6',
            'foto' => 'nullable|image|max:2048',
        ]);

        // Simpan foto jika ada
        $fotoPath = $request->file('foto') ? $request->file('foto')->store('kader_fotos', 'public') : null;

        Kader::create([
            'nik' => $validated['nik'],
            'nama' => $validated['nama'],
            'alamat' => $validated['alamat'],
            'jabatan' => $validated['jabatan'],
            'password' => Hash::make($validated['password']),
            'foto' => $fotoPath,
        ]);

        return redirect()->route('admin.kelola_kader')->with('success', 'Kader berhasil ditambahkan!');
    }

    // Tampilkan form edit kader
    public function edit($id)
    {
        $kader = Kader::findOrFail($id);
        return response()->json($kader);
    }

    // Perbarui data kader
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'alamat' => 'required|string',
            'jabatan' => 'required|string|max:50',
            'foto' => 'nullable|image|max:2048',
        ]);

        $kader = Kader::findOrFail($id);

        // Update foto jika ada
        if ($request->hasFile('foto')) {
            if ($kader->foto) {
                Storage::disk('public')->delete($kader->foto);
            }
            $validated['foto'] = $request->file('foto')->store('kader_fotos', 'public');
        }

        $kader->update($validated);

        return redirect()->route('admin.kelola_kader')->with('success', 'Data kader berhasil diperbarui!');
    }

    // Hapus kader
    public function destroy($id)
    {
        $kader = Kader::findOrFail($id);

        // Hapus foto jika ada
        if ($kader->foto) {
            Storage::disk('public')->delete($kader->foto);
        }

        $kader->delete();
        return response()->json(['success' => 'Kader berhasil dihapus!']);
    }
}
