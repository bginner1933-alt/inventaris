<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class KategoriController extends Controller
{
    /**
     * Menampilkan daftar kategori dengan fitur pencarian.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        
        // Mengambil data berdasarkan kolom 'nama' sesuai ERD
        $categories = Kategori::when($search, function ($query, $search) {
            return $query->where('nama', 'like', "%{$search}%");
        })->latest()->get();

        return view('dashboard.kategori.index', compact('categories'));
    }

    /**
     * Menampilkan form tambah kategori.
     */
    public function create()
    {
        return view('dashboard.kategori.create');
    }

    /**
     * Menyimpan kategori baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'      => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'image'     => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->all();

        // Handle upload gambar ke folder public
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $nama_file = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('uploads/categories'), $nama_file);
            $data['image'] = 'uploads/categories/' . $nama_file;
        }

        Kategori::create($data);

        return redirect()->route('dashboard.kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail kategori (opsional).
     */
    public function show(string $id)
    {
        $kategori = Kategori::with('barangs')->findOrFail($id);
        return view('dashboard.kategori.show', compact('kategori'));
    }

    /**
     * Menampilkan form edit kategori.
     */
    public function edit(string $id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('dashboard.kategori.edit', compact('kategori'));
    }

    /**
     * Memperbarui data kategori di database.
     */
    public function update(Request $request, string $id)
    {
        $kategori = Kategori::findOrFail($id);

        $request->validate([
            'nama'      => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'image'     => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada file fisiknya
            if ($kategori->image && File::exists(public_path($kategori->image))) {
                File::delete(public_path($kategori->image));
            }

            $file = $request->file('image');
            $nama_file = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('uploads/categories'), $nama_file);
            $data['image'] = 'uploads/categories/' . $nama_file;
        }

        $kategori->update($data);

        return redirect()->route('dashboard.kategori.index')
            ->with('success', 'Kategori berhasil diperbarui!');
    }

    /**
     * Menghapus kategori dan file gambarnya.
     */
    public function destroy(string $id)
    {
        $kategori = Kategori::findOrFail($id);

        // Hapus file fisik gambar sebelum hapus data di database
        if ($kategori->image && File::exists(public_path($kategori->image))) {
            File::delete(public_path($kategori->image));
        }

        $kategori->delete();

        return redirect()->route('dashboard.kategori.index')
            ->with('success', 'Kategori berhasil dihapus!');
    }
}