<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Location; 
use App\Models\Peminjaman;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'totalBarang'     => Barang::sum('jumlah'),
            'totalKategori'   => Kategori::count(),
            // PERBAIKAN: Menggunakan Location (sesuai import di atas)
            'totalLokasi'     => Location::count(), 
            'peminjamanAktif' => Peminjaman::where('status', 'dipinjam')->count(),
            'riwayatTerbaru'  => Peminjaman::with(['user', 'detail.barang'])
                                ->latest()
                                ->take(5)
                                ->get()
        ];

        return view('dashboard.index', $data);
    }
}