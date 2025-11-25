@extends('layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <h1 class="text-2xl font-bold mb-6 text-amber-900">Edit Produk</h1>

    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block font-medium mb-2">Nama Produk</label>
            <input type="text" name="name" class="w-full border rounded-md px-3 py-2" value="{{ $product->name }}" required>
        </div>

        <div class="mb-4">
            <label class="block font-medium mb-2">Harga (Rp)</label>
            <input type="number" name="price" class="w-full border rounded-md px-3 py-2" value="{{ $product->price }}" required>
        </div>

        <div class="mb-4">
            <label class="block font-medium mb-2">Stok</label>
            <input type="number" name="stock" class="w-full border rounded-md px-3 py-2" value="{{ $product->stock }}" required>
        </div>

        <div class="flex justify-end gap-3">
            <a href="{{ route('products.index') }}" class="px-4 py-2 rounded-lg bg-gray-300 hover:bg-gray-400">Kembali</a>
            <button type="submit" class="px-4 py-2 rounded-lg bg-amber-900 text-white hover:bg-amber-700">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection
