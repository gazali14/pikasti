<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kader;
use Illuminate\Support\Facades\Storage;

class AdminKelolaKaderController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $kaders = Kader::query()
            ->when($search, function ($query) use ($search) {
                $query->where('nama', 'LIKE', "%{$search}%")
                    ->orWhere('alamat', 'LIKE', "%{$search}%")
                    ->orWhere('jabatan', 'LIKE', "%{$search}%");
            })
            ->get();

        return view('admin.kelola_kader', compact('kaders'));
    }

    public function store(Request $request)
    {
        if ($request->id) {
            $validated = $request->validate([
                'nama' => 'required|string|max:100',
                'alamat' => 'required|string|max:255',
                'jabatan' => 'required|string|max:50',
                'password' => 'required|string|min:8',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            $kader = Kader::findOrFail($request->id);
            $validated['password'] = bcrypt($validated['password']);
            $kader->update($validated);

            // Update foto jika ada file baru diupload
            if ($request->hasFile('foto')) {
                // Hapus foto lama jika ada
                if ($kader->foto) {
                    Storage::disk('public')->delete($kader->foto);
                }
                $kader->foto = $request->file('foto')->store('img', 'public');
                $kader->save();
            }
        } else {
            $validated = $request->validate([
                'nik' => 'required|min:16|max:16|unique:kaders,nik,' . $request->id,
                'nama' => 'required|string|max:100',
                'alamat' => 'required|string|max:255',
                'jabatan' => 'required|string|max:50',
                'password' => 'required|string|min:8',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            // Jika data baru, hash password
            $validated['password'] = bcrypt($validated['password']);

            // Simpan foto jika ada
            $validated['foto'] = $request->file('foto')
                ? $request->file('foto')->store('img', 'public')
                : null;

            Kader::create($validated);
        }

        return redirect()->route('admin.kelola_kader.index')->with('success', 'Data kader berhasil disimpan!');
    }


    public function edit($id)
    {
        $kader = Kader::findOrFail($id);
        return response()->json($kader);
    }

    public function destroy($id)
    {
        $kader = Kader::findOrFail($id);

        // Hapus foto jika ada
        if ($kader->pas_foto) {
            Storage::disk('public')->delete($kader->pas_foto);
        }

        $kader->delete();

        return redirect()->route('admin.kelola_kader.index')->with('success', 'Kader berhasil dihapus.');
    }
}
