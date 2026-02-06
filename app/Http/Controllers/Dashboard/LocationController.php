<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Location; 
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index()
    {
        $locations = Location::latest()->get();
        return view('dashboard.location.index', compact('locations'));
    }

    public function create()
    {
        return view('dashboard.location.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string'
        ]);

        Location::create($request->all());

        return redirect()->back()->with('success', 'Lokasi berhasil ditambahkan!');
    }

    public function show(Location $location)
    {
        return view('dashboard.location.show', compact('location'));
    }

    public function edit(Location $location)
    {
        return view('dashboard.location.edit', compact('location'));
    }

    public function destroy(Location $location)
    {
        $location->delete();

        return redirect()
            ->route('dashboard.location.index')
            ->with('success', 'Location berhasil dihapus');
    }
}