<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = ['name', 'price', 'category_id'];

    // Jika pakai timestamps
    public $timestamps = true;

    // Relasi dengan category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
