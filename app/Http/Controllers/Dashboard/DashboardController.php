<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Location; // Sesuaikan dengan nama model lokasi Anda
use App\Models\Peminjaman;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'totalBarang'     => Barang::count(),
            'totalKategori'   => Kategori::count(),
            'totalLokasi'     => Location::count(),
            'peminjamanAktif' => Peminjaman::where('status', 'dipinjam')->count(),
            'riwayatTerbaru'  => Peminjaman::with(['user', 'barang', 'location']) // Eager loading agar ringan
                                ->latest()
                                ->take(5)
                                ->get()
        ];

        return view('dashboard.index', $data);
    }
}
