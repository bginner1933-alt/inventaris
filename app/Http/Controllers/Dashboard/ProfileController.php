<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        return view('dashboard.profile.index');
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        // 1. Validasi Input
        $request->validate([
            'name'     => 'required|string|max:255',
            'photo'    => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Max 2MB
            'password' => 'nullable|string|min:8', // Password opsional
        ]);

        // 2. Update Nama
        $user->name = $request->name;

        // 3. Logic Ganti Foto
        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada di storage agar tidak nyampah
            if ($user->photo && Storage::disk('public')->exists($user->photo)) {
                Storage::disk('public')->delete($user->photo);
            }

            // Simpan foto baru ke folder 'profiles' di storage/app/public
            $path = $request->file('photo')->store('profiles', 'public');
            $user->photo = $path;
        }

        // 4. Update Password (hanya jika diisi)
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return back()->with('success', 'Profil kamu berhasil diperbarui!');
    }
}