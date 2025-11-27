<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
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

    protected $table = 'sales';

    public function Product()
    {
        return $this->belongsTo(Product::class)
    }
}
