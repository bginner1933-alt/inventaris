<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kategori extends Model {
    protected $table = 'kategori';
    protected $fillable = ['nama', 'deskripsi'];

    public function barangs() {
        return $this->hasMany(Barang::class, 'kategori_id');
    }
}