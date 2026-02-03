<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request) // Tambahkan Request $request
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
        $request->validate(['name' => 'required|string|max:255']);
        Category::create($request->all());

        return redirect()->route('dashboard.category.index')->with('success', 'Category berhasil dibuat.');
    }

    public function edit(Category $category)
    {
        return view('dashboard.category.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $category->update($request->all());

        return redirect()->route('dashboard.category.index')->with('success', 'Category berhasil diupdate.');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('dashboard.category.index')->with('success', 'Category berhasil dihapus.');
    }
    
    public function show($id)
    {
        $category = Category::with('products')->findOrFail($id);

        return view('categories.show', compact('category'));
    }
}
