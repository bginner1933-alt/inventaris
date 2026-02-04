<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
// Ganti bagian ini agar mengarah ke Model 'Location' bukan 'Lokasi'
use App\Models\Location; 
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index()
    {
        // Panggil 'Location', jangan 'Lokasi'
        $locations = Location::latest()->get(); 
        return view('dashboard.location.index', compact('locations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string'
        ]);

        // Panggil 'Location' di sini juga
        Location::create($request->all());

        return redirect()->back()->with('success', 'Lokasi berhasil ditambahkan!');
    }
}