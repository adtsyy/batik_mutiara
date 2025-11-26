<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'code',      // Kode Produk
        'name',      // Nama Produk
        'category',  // Kategori (enum)
        'price',     // Harga Produk
        'stock'      // Stok Produk
    ];
}
