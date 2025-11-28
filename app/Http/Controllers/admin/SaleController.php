<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\User;
use App\Models\Product;

class SaleController extends Controller
{
    // Tampilkan daftar penjualan
    public function index(Request $request)
    {
        $search = $request->search;

        $sales = Sale::query()
            ->when($search, function ($q) use ($search) {
                $q->where('invoiceNumber', 'like', "%$search%")
                  ->orWhere('cashierName', 'like', "%$search%");
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.sales.index', [
            'sales' => $sales,
        ]);
    }

    // Tampilkan detail penjualan
    public function show(Sale $sale)
    {
        return view('admin.sales.show', compact('sale'));
    }

    // Tampilkan form edit penjualan
    public function edit(Sale $sale)
    {
        return view('admin.sales.edit', [
            'sale' => $sale,
            'cashiers' => User::where('role', 'cashier')->get(),
            'products' => Product::all()
        ]);
    }

    // Update penjualan
    public function update(Request $request, Sale $sale)
    {
        $data = $request->validate([
            'invoiceNumber' => 'required',
            'cashierId' => 'required',
            'paymentMethod' => 'required',
            'products' => 'required|array|min:1',
            'products.*.productId' => 'required',
            'products.*.quantity' => 'required|numeric',
            'products.*.price' => 'required|numeric',
        ]);

        $total = collect($data['products'])
            ->sum(fn($p) => $p['quantity'] * $p['price']);

        $cashier = User::find($data['cashierId']);

        $sale->update([
            'invoiceNumber' => $data['invoiceNumber'],
            'cashierId' => $data['cashierId'],
            'cashierName' => $cashier->name,
            'paymentMethod' => $data['paymentMethod'],
            'products' => $data['products'],
            'total' => $total,
        ]);

        return redirect()->route('sales.index')
                        ->with('success', 'Data berhasil diubah');
    }

    // Tambah produk sementara ke "keranjang"
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'qty' => 'required|integer|min:1'
        ]);

        $cart = session()->get('cart', []);

        $cart[] = [
            'product_id' => $request->product_id,
            'qty' => $request->qty,
        ];

        session()->put('cart', $cart);

        return back()->with('success', 'Produk ditambahkan ke keranjang');
    }
}
