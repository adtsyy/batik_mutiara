<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index() {
        $products = Product::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.produk.index', compact('products'));
    }

    public function create() {
        return view('admin.produk.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'code' => 'required|unique:products,code',
            'price' => 'required|numeric',
        ]);

        Product::create($request->all());

        return redirect()->route('admin.produk.index')
                         ->with('success', 'Produk berhasil ditambahkan');
    }
}
