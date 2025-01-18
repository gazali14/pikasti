<?php

namespace App\Http\Controllers;

use App\Models\Bayi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class KohortController extends Controller
{
    // Display the list of babies
    public function index(Request $request)
    {
        if (!Auth::guard('kader')->user()->is_admin) {
            return redirect()->route('orang_tua.before_login.login')->withErrors(['error' => 'Anda tidak memiliki akses ke halaman ini!']);
        }
        try {
            $selectedKader = Auth::guard('kader')->user();
            $search = $request->input('search');
            $bayis = Bayi::when($search, function ($query, $search) {
                return $query->where('nama', 'like', "%$search%");
            })
            ->orderBy('nama', 'asc')
            ->paginate(10);

            return view('admin.kohort', compact('bayis', 'selectedKader'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memuat data: ' . $e->getMessage());
        }
    }

    // Show the form for editing a specific baby using nik
    public function edit($nik)
    {
        try {
            $bayi = Bayi::where('nik', $nik)->firstOrFail();
            return response()->json($bayi);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan saat memuat data bayi: ' . $e->getMessage()], 500);
        }
    }

    // Update the specified baby in storage using nik
    public function update(Request $request, $nik)
    {
        try {
            $bayi = Bayi::where('nik', $nik)->firstOrFail();

            $request->validate([
                'nik' => 'required|numeric|unique:bayis,nik,' . $bayi->id,
                'nama' => 'required|string|max:255',
                'nama_ibu' => 'required|string|max:255',
                'jenis_kelamin' => 'required|string|in:Perempuan,Laki-Laki',
                'tanggal_lahir' => 'required|date',
                'berat_badan_lahir' => 'required|numeric|min:0',
                'tinggi_badan_lahir' => 'required|numeric|min:0',
                'alamat' => 'required|string|max:500',
                'password' => 'nullable|string|min:6',
            ]);

            $bayi->fill($request->except('password'));

            if ($request->filled('password')) {
                $bayi->password = Hash::make($request->password);
            }

            $bayi->save();

            return redirect()->route('kohort.index')->with('success', 'Data bayi berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui data bayi: ' . $e->getMessage());
        }
    }
    public function destroy($nik)
    {
        try {
            $bayi = Bayi::where('nik', $nik)->firstOrFail();
            $bayi->delete();

            return redirect()->route('kohort.index')->with('success', 'Data bayi berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data bayi: ' . $e->getMessage());
        }
    }


    public function store(Request $request)
    {
        try {
            $request->validate([
                'nik' => 'required|numeric|unique:bayis,nik',
                'nama' => 'required|string|max:255',
                'nama_ibu' => 'required|string|max:255',
                'jenis_kelamin' => 'required|string|in:Perempuan,Laki-Laki',
                'tanggal_lahir' => 'required|date',
                'berat_badan_lahir' => 'required|numeric|min:0',
                'tinggi_badan_lahir' => 'required|numeric|min:0',
                'alamat' => 'required|string|max:500',
                'password' => 'required|string|min:6',
            ]);

            Bayi::create([
                'nik' => $request->nik,
                'nama' => $request->nama,
                'nama_ibu' => $request->nama_ibu,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tanggal_lahir' => $request->tanggal_lahir,
                'berat_badan_lahir' => $request->berat_badan_lahir,
                'tinggi_badan_lahir' => $request->tinggi_badan_lahir,
                'alamat' => $request->alamat,
                'password' => Hash::make($request->password),
            ]);

            return redirect()->route('kohort.index')->with('success', 'Data bayi berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan data bayi: ' . $e->getMessage());
        }
    }
}
