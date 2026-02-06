<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Location;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Menampilkan daftar barang
     */
    public function index()
    {
        // Mengambil semua barang beserta relasi kategorinya
        $barangs = Barang::with(['kategori', 'lokasi'])->latest()->get();
        
        // PASTIKAN foldernya dashboard/barang/index
        return view('dashboard.barang.index', compact('barangs'));
    }

    /**
     * Menampilkan form tambah barang
     */
    public function create()
    {
        $categories = Kategori::all();
        $locations = Location::all();
        
        return view('dashboard.barang.create', compact('categories', 'locations'));
    }

    /**
     * Menyimpan data barang baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_barang'   => 'required|unique:barang,kode_barang',
            'nama_barang'   => 'required|string|max:255',
            'kategori_id'   => 'required|exists:kategori,id',
            'lokasi_id'     => 'required|exists:lokasi,id',
            'stok'          => 'required|integer|min:0',
            'satuan'        => 'required|string',
            'kondisi'       => 'required|in:baik,rusak_ringan,rusak_berat,hilang',
            'tanggal_beli'  => 'required|date',
            'harga'         => 'required|numeric|min:0',
        ]);

        // 👇 SIMPAN DI SINI (INI JAWABAN PERTANYAAN KAMU)
        $data = [
            'kode_barang'  => $request->kode_barang,
            'nama_barang'  => $request->nama_barang,
            'kategori_id'  => $request->kategori_id,
            'lokasi_id'    => $request->lokasi_id,
            'jumlah'       => $request->stok, // mapping stok → jumlah
            'satuan'       => $request->satuan,
            'kondisi'      => $request->kondisi,
            'tanggal_beli' => $request->tanggal_beli,
            'harga'        => $request->harga,
        ];

        Barang::create($data); // ⬅️ DISIMPAN KE DATABASE DI SINI

        return redirect()->route('dashboard.barang.index')
            ->with('success', 'Barang berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail barang (Show)
     */
    public function show($id)
    {
        $barang = Barang::with(['kategori', 'lokasi'])->findOrFail($id);
        return view('dashboard.barang.show', compact('barang'));
    }

    /**
     * Menampilkan form edit barang
     */
    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        $categories = Kategori::all();
        $locations = Location::all();

        return view('dashboard.barang.edit', compact('barang', 'categories', 'locations'));
    }

    /**
     * Memperbarui data barang
     */
    public function update(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);
        
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'stok'        => 'required|integer|min:0',
        ]);

        $data = $request->all();
        // Samakan juga di bagian update
        $data['jumlah'] = $request->stok;

        $barang->update($data);

        return redirect()->route('dashboard.barang.index')
            ->with('success', 'Data barang berhasil diperbarui!');
    }

    /**
     * Menghapus barang
     */
    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();

        return redirect()->route('dashboard.barang.index')
            ->with('success', 'Barang berhasil dihapus!');
    }
}