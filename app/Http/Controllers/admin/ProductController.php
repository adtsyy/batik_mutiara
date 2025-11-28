<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // LIST PRODUK
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.produk.index', compact('products'));
    }

    // FORM TAMBAH
    public function create()
    {
        return view('admin.produk.create');
    }

    // SIMPAN DATA BARU
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:products,code',
            'name' => 'required',
            'category' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
        ]);

        Product::create($request->all());

        return redirect()->route('products.index')
                 ->with('success', 'Produk berhasil ditambahkan');
    }

    // FORM EDIT
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.produk.edit', compact('product'));
    }

    // UPDATE DATA
    public function update(Request $request, $id)
    {
        $request->validate([
            'code' => 'required|unique:products,code,' . $id,
            'name' => 'required',
            'category' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
        ]);

        $product = Product::findOrFail($id);
        $product->update($request->all());

        return redirect()->route('products.index')
                         ->with('success', 'Produk berhasil diperbarui');
    }

    // HAPUS PRODUK
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index')
                 ->with('success', 'Produk berhasil dihapus');
    }
}
