@extends('layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <h1 class="text-2xl font-bold mb-6 text-amber-900">Tambah Produk</h1>

    <form action="{{ route('products.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block font-medium mb-2">Kode Produk</label>
            <input type="text" name="code" class="w-full border rounded-md px-3 py-2" placeholder="Misal: BTK001" required>
        </div>

        <div class="mb-4">
            <label class="block font-medium mb-2">Nama Produk</label>
            <input type="text" name="name" class="w-full border rounded-md px-3 py-2" placeholder="Masukkan nama produk" required>
        </div>

        <div class="mb-4">
            <label class="block font-medium mb-2">Kategori</label>
            <select name="category" class="w-full border rounded-md px-3 py-2" required>
                <option value="Batik Tulis">Batik Tulis</option>
                <option value="Batik Cap">Batik Cap</option>
                <option value="Batik Printing">Batik Printing</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="block font-medium mb-2">Harga (Rp)</label>
            <input type="number" name="price" class="w-full border rounded-md px-3 py-2" placeholder="Masukkan harga" required>
        </div>

        <div class="mb-4">
            <label class="block font-medium mb-2">Stok</label>
            <input type="number" name="stock" class="w-full border rounded-md px-3 py-2" placeholder="Masukkan stok" required>
        </div>

        <div class="flex justify-end gap-3">
            <a href="{{ route('products.index') }}" class="px-4 py-2 rounded-lg bg-gray-300 hover:bg-gray-400">Kembali</a>
            <button type="submit" class="px-4 py-2 rounded-lg bg-amber-900 text-white hover:bg-amber-700">Simpan</button>
        </div>
    </form>
</div>
@endsection
