<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use App\Models\Sale;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
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

    public function show(Sale $sale)
    {
        return view('admin.sales.show', compact('sale'));
    }

    public function edit(Sale $sale)
    {
        return view('admin.sales.edit', [
            'sale' => $sale,
            'cashiers' => User::where('role', 'cashier')->get(),
            'products' => Product::all()
        ]);
    }

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

    public function add(Request $request)
    {
        // Validasi basic
        $request->validate([
            'product_id' => 'required',
            'qty' => 'required|integer|min:1'
        ]);
    
        // Logic nambah ke keranjang (sementara demo)
        // Nanti bisa kamu sambung ke database / session

        // contoh simpan ke session
        $cart = session()->get('cart', []);

        $cart[] = [
            'product_id' => $request->product_id,
            'qty' => $request->qty,
        ];

        session()->put('cart', $cart);

        return back()->with('success', 'Produk ditambahkan ke keranjang');
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|integer|min:1',
        ]);

        DB::transaction(function () use ($request) {
            $product = Product::find($request->product_id);
            
            // Cek stok
            if ($product->stock < $request->qty) {
                throw new \Exception("Stok tidak cukup! Stok tersedia: {$product->stock}");
            }

            // Buat invoice number
            $invoiceNumber = 'INV-' . date('YmdHis') . rand(1000, 9999);

            // Buat Sale header
            $sale = Sale::create([
                'invoiceNumber' => $invoiceNumber,
                'cashierId' => auth()->id() ?? session('user_id'),
                'cashierName' => auth()->user()->name ?? session('cashier_name') ?? 'Cashier',
                'paymentMethod' => 'cash',
                'products' => json_encode([
                    [
                        'id' => $product->id,
                        'name' => $product->name,
                        'qty' => $request->qty,
                        'price' => $product->price,
                    ]
                ]),
                'total' => $product->price * $request->qty,
            ]);

            // Buat Detail Penjualan
            Detail::create([
                'id_penjualan' => $sale->id_sales,
                'id_product' => $product->id,
                'jumlah' => $request->qty,
                'subtotal' => $product->price * $request->qty,
            ]);

            // Kurangi stok produk
            $product->decrement('stock', $request->qty);
        });

        return redirect()->route('cashier.sales.create')
            ->with('success', 'Penjualan berhasil disimpan!');
    }
}
