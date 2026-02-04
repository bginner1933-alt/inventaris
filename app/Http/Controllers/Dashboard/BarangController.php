<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Barang;   // Sesuaikan model
use App\Models\Kategori; // Sesuaikan model
use App\Models\Lokasi;   // Tambahkan lokasi sesuai ERD
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index() {
        $categories = Kategori::latest()->get();
        return view('dashboard.kategori.index', compact('categories'));
    }
}