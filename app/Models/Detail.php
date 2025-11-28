<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    protected $fillable = [
        'id_penjualan',
        'id_produk',
        'jumlah',
        'subtotal'
    ];

}
