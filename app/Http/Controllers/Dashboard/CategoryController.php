<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Tambahkan ini

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $categories = Category::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%");
        })->get();

        return view('dashboard.category.index', compact('categories'));
    }

    public function create()
    {
        return view('dashboard.category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $nama_file = time() . "_" . $file->getClientOriginalName();
            
            // Simpan LANGSUNG ke folder public/uploads/categories
            $file->move(public_path('uploads/categories'), $nama_file);
            
            // Simpan path relatifnya ke database
            $data['image'] = 'uploads/categories/' . $nama_file;
        }

        Category::create($data);
        return redirect()->route('dashboard.category.index')->with('success', 'Berhasil!');
    }

    public function edit(Category $category)
    {
        return view('dashboard.category.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Hapus file lama jika ada sebelum ganti yang baru
            if ($category->image && Storage::disk('public')->exists($category->image)) {
                Storage::disk('public')->delete($category->image);
            }
            // Gunakan folder 'categories' (disamakan dengan store)
            $data['image'] = $request->file('image')->store('categories', 'public');
        }

        $category->update($data);

        return redirect()->route('dashboard.category.index')->with('success', 'Category berhasil diupdate.');
    }

    public function destroy(Category $category)
    {
        // Hapus file foto dari storage saat kategori dihapus
        if ($category->image && Storage::disk('public')->exists($category->image)) {
            Storage::disk('public')->delete($category->image);
        }
        
        $category->delete();
        return redirect()->route('dashboard.category.index')->with('success', 'Category berhasil dihapus.');
    }

    public function show($id)
    {
        $category = Category::with('products')->findOrFail($id);
        return view('dashboard.category.show', compact('category'));
    }
}