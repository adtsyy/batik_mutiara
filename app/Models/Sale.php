<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Sale extends Model
{
    protected $table = 'sales';

    protected $fillable = [
        'invoiceNumber',
        'cashierId',
        'cashierName',
        'paymentMethod',
        'products', // disimpan sebagai JSON
        'total',
    ];

    // otomatis cast products menjadi array
    protected $casts = [
        'products' => 'array',
    ];

    /**
     * Accessor untuk menampilkan detail produk
     */
    public function getProductDetailsAttribute()
    {
        return collect($this->products)->map(function ($item) {
            $product = Product::find($item['productId']);
            return $product ? [
                'productId' => $item['productId'],
                'productName' => $product->name,
                'quantity' => $item['quantity'] ?? 0,
                'price' => $item['price'] ?? 0,
                'subtotal' => ($item['quantity'] ?? 0) * ($item['price'] ?? 0),
            ] : null;
        })->filter(); // buang null kalau product gak ada
    }
}
