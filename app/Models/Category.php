<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // Nama table (opsional kalau mengikuti konvensi Laravel: "categories")
    protected $table = 'categories';

    // Fillable → biar bisa diisi massal lewat create/update
    protected $fillable = ['name'];

    // Jika pakai timestamps (created_at, updated_at)
    public $timestamps = true;
}
