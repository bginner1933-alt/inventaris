<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Menggunakan DB agar lebih pasti

class SearchController extends Controller
{
    public function globalSearch(Request $request)
    {
        // Ambil input dan bersihkan dari spasi, ubah ke huruf kecil
        $q = trim(strtolower($request->get('q')));

        if (empty($q)) {
            return response()->json(['products' => [], 'categories' => [], 'users' => []]);
        }

        // Cari Kategori (Menggunakan LOWER agar tidak peduli huruf besar/kecil)
        $categories = \App\Models\Category::whereRaw('LOWER(name) LIKE ?', ["%{$q}%"])
            ->limit(5)
            ->get(['id', 'name']);

        // Cari Produk
        $products = \App\Models\Product::whereRaw('LOWER(name) LIKE ?', ["%{$q}%"])
            ->limit(5)
            ->get(['id', 'name']);

        // Cari User
        $users = \App\Models\User::whereRaw('LOWER(name) LIKE ?', ["%{$q}%"])
            ->orWhereRaw('LOWER(email) LIKE ?', ["%{$q}%"])
            ->limit(5)
            ->get(['id', 'name']);

        return response()->json([
            'categories' => $categories,
            'products'   => $products,
            'users'      => $users
        ]);
    }
}