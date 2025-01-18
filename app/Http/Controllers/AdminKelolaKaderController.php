<?php

namespace App\Http\Controllers;

use App\Models\Kader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AdminKelolaKaderController extends Controller
{
    public function index(Request $request)
    {
        try {
            if (!Auth::guard('kader')->user()->is_admin) {
                return redirect()->route('orang_tua.before_login.login')->withErrors(['error' => 'Anda tidak memiliki akses ke halaman ini!']);
            }
            $selectedKader = Auth::guard('kader')->user();
            $search = $request->input('search');
            $kaders = Kader::query()
                ->when($search, function ($query) use ($search) {
                    $query->where('nama', 'LIKE', "%{$search}%");
                })
                ->orderBy('nama', 'asc')
                ->paginate(5);

            return view('admin.kelola_kader', compact('kaders', 'selectedKader'));
        } catch (\Exception $e) {
            Log::error('Kesalahan saat memuat data kader: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memuat data kader: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            if ($request->id) {
                $validated = $request->validate([
                    'nama' => 'required|string|max:100',
                    'alamat' => 'required|string|max:255',
                    'jabatan' => 'required|string|max:50',
                    'password' => 'nullable|string|min:8',
                    'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                ]);

                $kader = Kader::findOrFail($request->id);
                if ($validated['password']) {
                    $validated['password'] = bcrypt($validated['password']);
                } else {
                    $validated['password'] = $kader->password;
                }
                $kader->update($validated);

                if ($request->hasFile('foto')) {
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

                $validated['password'] = bcrypt($validated['password']);
                $validated['foto'] = $request->file('foto')
                    ? $request->file('foto')->store('img', 'public')
                    : null;

                Kader::create($validated);
            }

            return redirect()->route('admin.kelola_kader.index')->with('success', 'Data kader berhasil disimpan!');
        } catch (\Exception $e) {
            Log::error('Kesalahan saat menyimpan data kader: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data kader: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $kader = Kader::findOrFail($id);
            return response()->json($kader);
        } catch (\Exception $e) {
            Log::error('Kesalahan saat mengambil data kader untuk diedit: ' . $e->getMessage());
            return response()->json(['error' => 'Terjadi kesalahan saat mengambil data kader: ' . $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $kader = Kader::findOrFail($id);

            if ($kader->pas_foto) {
                Storage::disk('public')->delete($kader->pas_foto);
            }

            $kader->delete();

            return redirect()->route('admin.kelola_kader.index')->with('success', 'Kader berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('Kesalahan saat menghapus kader: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus kader: ' . $e->getMessage());
        }
    }
}
