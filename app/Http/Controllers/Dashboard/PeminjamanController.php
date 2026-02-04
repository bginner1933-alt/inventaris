<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\DetailPeminjaman;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    public function index() {
        $peminjaman = Peminjaman::with('user')->latest()->get();
        return view('dashboard.peminjaman.index', compact('peminjaman'));
    }

    public function create() {
        // Ubah 'stok' menjadi 'jumlah'
        $barang = Barang::where('jumlah', '>', 0)->get(); 
        return view('dashboard.peminjaman.create', compact('barang'));
    }

    public function store(Request $request) {
        // Logic simpan transaksi dan detailnya
        $peminjaman = Peminjaman::create([
            'kode_peminjaman' => 'TRX-' . time(),
            'nama_peminjam' => $request->nama_peminjam,
            'jenis_peminjam' => $request->jenis_peminjam,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'status' => 'dipinjam',
            'user_id' => Auth::id(),
        ]);

        DetailPeminjaman::create([
            'peminjaman_id' => $peminjaman->id,
            'barang_id' => $request->barang_id,
            'jumlah' => $request->jumlah,
            'kondisi_sebelum' => $request->kondisi,
        ]);

        return redirect()->route('dashboard.peminjaman.index')->with('success', 'Peminjaman berhasil!');
    }
}