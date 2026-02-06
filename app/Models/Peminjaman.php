<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjaman';
    protected $fillable = [
        'kode_peminjaman', 'nama_peminjam', 'jenis_peminjam', 
        'tanggal_pinjam', 'tanggal_kembali', 'status', 'user_id'
    ];

    // Relasi ke User (Petugas)
    public function user() {
        return $this->belongsTo(User::class);
    }

    // Relasi ke banyak detail (untuk sistem yang mengizinkan banyak barang sekali pinjam)
    public function details() {
        return $this->hasMany(DetailPeminjaman::class, 'peminjaman_id');
    }

    // PENTING: Tambahkan ini agar DashboardController tidak error saat memanggil with('detail.barang')
    public function detail() {
        return $this->hasOne(DetailPeminjaman::class, 'peminjaman_id');
    }
}