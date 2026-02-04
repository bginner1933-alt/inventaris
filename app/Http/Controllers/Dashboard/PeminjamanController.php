<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\DetailPeminjaman;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
    public function index() {
        $peminjaman = Peminjaman::with('user')->latest()->get();
        return view('dashboard.peminjaman.index', compact('peminjaman'));
    }

    public function create() {
        // Ambil barang yang stoknya lebih dari 0
        $barang = Barang::where('stok', '>', 0)->get();
        return view('dashboard.peminjaman.create', compact('barang'));
    }

    public function store(Request $request) {
        $request->validate([
            'nama_peminjam' => 'required',
            'barang_id' => 'required',
            'jumlah' => 'required|integer|min:1',
            'tanggal_pinjam' => 'required|date',
        ]);

        // Gunakan Database Transaction agar jika satu gagal, semua batal (aman)
        DB::beginTransaction();
        try {
            $barang = Barang::findOrFail($request->barang_id);

            // Cek apakah stok cukup
            if ($barang->stok < $request->jumlah) {
                return redirect()->back()->with('error', 'Stok tidak mencukupi!');
            }

            // 1. Simpan ke tabel Peminjaman
            $peminjaman = Peminjaman::create([
                'kode_peminjaman' => 'PJN-' . strtoupper(uniqid()),
                'nama_peminjam' => $request->nama_peminjam,
                'jenis_peminjam' => $request->jenis_peminjam ?? 'Umum',
                'tanggal_pinjam' => $request->tanggal_pinjam,
                'status' => 'dipinjam',
                'user_id' => Auth::id(),
            ]);

            // 2. Simpan ke tabel Detail Peminjaman
            DetailPeminjaman::create([
                'peminjaman_id' => $peminjaman->id,
                'barang_id' => $request->barang_id,
                'jumlah' => $request->jumlah,
                'kondisi_sebelum' => $request->kondisi_sebelum ?? 'Baik',
            ]);

            // 3. KURANGI STOK BARANG
            $barang->decrement('stok', $request->jumlah);

            DB::commit();
            return redirect()->route('dashboard.peminjaman.index')->with('success', 'Peminjaman berhasil dicatat!');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}