<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table = 'sales';
    protected $primaryKey = 'id_sales';
    protected $fillable = [
        'invoiceNumber',
        'cashierId',
        'cashierName',
        'paymentMethod',
        'products',
        'total',
    ];

    protected $casts = [
        'products' => 'array',
    ];

    public function details()
    {
        return $this->hasMany(Detail::class, 'id_penjualan', 'id_sales'); // Perbaiki relasi
    }
}
