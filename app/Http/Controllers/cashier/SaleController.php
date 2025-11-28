<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function index(Request $request)
    {
        $id_kasir = session('user_id');
        $query = Sale::with('detail.produk')->where('id_kasir', $id_kasir)->orderBy('tanggal_penjualan','desc');

        if ($request->filled('from')) {
            $query->whereDate('tanggal_penjualan', '>=', $request->from);
        }
        if ($request->filled('to')) {
            $query->whereDate('tanggal_penjualan', '<=', $request->to);
        }
        $penjualan = $query->get();

        // total keseluruhan / periode
        $totalAll = Sale::where('id_kasir', $id_kasir)->sum('total_harga');

        return view('kasir.penjualan.index', compact('penjualan','totalAll'));
    }

    public function create()
    {
        $produk = Product::where('stok','>',0)->get();
        return view('kasir.penjualan.create', compact('produk'));
    }

    public function store(Request $r)
    {
        $r->validate([
            'tanggal' => 'required|date',
            'produk' => 'required|array',
            'produk.*' => 'required|integer|exists:produk,id_produk',
            'jumlah' => 'required|array',
            'jumlah.*' => 'required|integer|min:1',
        ]);

        DB::transaction(function() use ($r) {
            // 1. buat penjualan header
            $penjualan = Sale::create([
                'tanggal_penjualan' => $r->tanggal,
                'total_harga' => 0,
                'id_kasir' => session('user_id'),
                'id_admin' => null
            ]);

            $total = 0;
            foreach ($r->produk as $index => $id_produk) {
                $jumlah = intval($r->jumlah[$index]);
                $produk = Product::where('id_produk', $id_produk)->lockForUpdate()->first(); // lock for concurrency
                if (!$produk) throw new \Exception("Produk tidak ditemukan");
                if ($produk->stok < $jumlah) {
                    throw new \Exception("Stok produk {$produk->nama_produk} tidak cukup (stok: {$produk->stok})");
                }
                $subtotal = bcmul($produk->harga, $jumlah, 2); // decimal safe
                Detail::create([
                    'id_penjualan' => $penjualan->id_penjualan,
                    'id_produk' => $id_produk,
                    'jumlah' => $jumlah,
                    'subtotal' => $subtotal
                ]);
                $produk->decrement('stok', $jumlah);
                $total += (float)$subtotal;
            }

            // update header total
            $penjualan->update(['total_harga' => $total]);
        });

        return redirect()->route('kasir.penjualan.index')->with('success','Penjualan tersimpan.');
    }
}
