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

    // Relasi ke banyak detail barang
    public function details() {
        return $this->hasMany(DetailPeminjaman::class, 'peminjaman_id');
    }
}