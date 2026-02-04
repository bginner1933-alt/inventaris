<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    // 1. Beritahu Laravel kalau nama tabelnya adalah 'lokasi' (bukan 'locations')
    protected $table = 'lokasi';

    // 2. Beritahu kolom mana saja yang boleh diisi lewat form
    protected $fillable = [
        'nama', 
        'deskripsi'
    ];
}