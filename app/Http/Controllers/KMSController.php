<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bayi;

class KMSController extends Controller
{
    public function index()
    {
        // Ambil semua data bayi dari database
        $bayiList = Bayi::all();
        
        // Kirim data bayi ke view
        return view('kader.kms', compact('bayiList'));
    }


    public function store(Request $request)
    {
        // Handle the form submission here, e.g., save selected bayi_id to a KMS record
        $bayiId = $request->input('bayi_id');

        // Example: Save to database or perform some action
        // KMS::create(['bayi_id' => $bayiId]);

        // Redirect or return a response
        return redirect()->route('kader.kms')->with('success', 'Data submitted successfully');
    }
}
