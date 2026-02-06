<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model {
    protected $table = 'barang';
    // app/Models/Barang.php

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'kategori_id',
        'lokasi_id',
        'jumlah',
        'satuan',
        'kondisi',
        'tanggal_beli',
        'harga',
        'deskripsi',
        'foto',
    ];

    public function kategori() {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    // Tambahkan relasi ke Location agar tidak error saat dipanggil di View
    public function lokasi() {
        return $this->belongsTo(Location::class, 'lokasi_id');
    }
}