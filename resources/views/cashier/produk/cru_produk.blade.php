@extends('layouts.cashier-navbar')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle mr-2"></i>{{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <p><i class="fas fa-exclamation-circle mr-2"></i>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- LEFT : Form Tambah Produk -->
        <div class="bg-white p-6 rounded-lg shadow-lg border border-gray-200">
            <h2 class="text-2xl font-bold mb-2 text-gray-800">Tambah Produk Baru</h2>
            <p class="text-gray-600 mb-6">Input data produk batik baru ke sistem</p>

            <form action="{{ route('cashier.product.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label class="block text-sm font-semibold mb-2 text-gray-700">Kode Produk</label>
                    <input type="text" name="code" placeholder="BTK008" value="{{ old('code') }}"
                        class="w-full border-2 border-gray-300 rounded-lg px-4 py-2 focus:border-amber-900 focus:outline-none transition @error('code') border-red-500 @enderror" required>
                    @error('code') <span class="text-red-500 text-sm"><i class="fas fa-times-circle mr-1"></i>{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-semibold mb-2 text-gray-700">Nama Produk</label>
                    <input type="text" name="name" placeholder="Batik Cap Solo" value="{{ old('name') }}"
                        class="w-full border-2 border-gray-300 rounded-lg px-4 py-2 focus:border-amber-900 focus:outline-none transition @error('name') border-red-500 @enderror" required>
                    @error('name') <span class="text-red-500 text-sm"><i class="fas fa-times-circle mr-1"></i>{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-semibold mb-2 text-gray-700">Kategori</label>
                    <select name="category" class="w-full border-2 border-gray-300 rounded-lg px-4 py-2 focus:border-amber-900 focus:outline-none transition @error('category') border-red-500 @enderror" required>
                        <option value="">-- Pilih Kategori --</option>
                        <option value="Batik Tulis" {{ old('category') == 'Batik Tulis' ? 'selected' : '' }}>Batik Tulis</option>
                        <option value="Batik Cap" {{ old('category') == 'Batik Cap' ? 'selected' : '' }}>Batik Cap</option>
                        <option value="Batik Printing" {{ old('category') == 'Batik Printing' ? 'selected' : '' }}>Batik Printing</option>
                    </select>
                    @error('category') <span class="text-red-500 text-sm"><i class="fas fa-times-circle mr-1"></i>{{ $message }}</span> @enderror
                </div>

                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div>
                        <label class="block text-sm font-semibold mb-2 text-gray-700">Harga (Rp)</label>
                        <input type="number" name="price" placeholder="200000" value="{{ old('price') }}"
                            class="w-full border-2 border-gray-300 rounded-lg px-4 py-2 focus:border-amber-900 focus:outline-none transition @error('price') border-red-500 @enderror" required>
                        @error('price') <span class="text-red-500 text-sm"><i class="fas fa-times-circle mr-1"></i>{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold mb-2 text-gray-700">Stok</label>
                        <input type="number" name="stock" placeholder="20" value="{{ old('stock') }}"
                            class="w-full border-2 border-gray-300 rounded-lg px-4 py-2 focus:border-amber-900 focus:outline-none transition @error('stock') border-red-500 @enderror" required>
                        @error('stock') <span class="text-red-500 text-sm"><i class="fas fa-times-circle mr-1"></i>{{ $message }}</span> @enderror
                    </div>
                </div>

                <button type="submit" class="w-full bg-amber-900 hover:bg-amber-800 text-white font-bold py-3 rounded-lg flex items-center justify-center gap-2 transition">
                    <i class="fas fa-plus"></i> Tambah Produk
                </button>
            </form>
        </div>

        <!-- RIGHT : Daftar Produk Terbaru -->
        <div class="bg-white p-6 rounded-lg shadow-lg border border-gray-200">
            <h2 class="text-2xl font-bold mb-2 text-gray-800">Produk Terbaru</h2>
            <p class="text-gray-500 mb-6"><i class="fas fa-info-circle mr-2"></i>{{ $products ? $products->count() : 0 }} produk tersedia</p>

            @if($products && $products->count() > 0)
                <div class="space-y-3 max-h-96 overflow-y-auto">
                    @foreach($products->sortByDesc('created_at')->take(10) as $p)
                        <div class="border-2 border-gray-200 rounded-lg p-4 hover:border-amber-900 hover:shadow-md transition">
                            <div class="flex justify-between items-start gap-2">
                                <div class="flex-1">
                                    <p class="font-bold text-gray-800">{{ $p->name }}</p>
                                    <p class="text-sm text-gray-500">{{ $p->code }} • <span class="bg-amber-100 text-amber-800 px-2 py-1 rounded text-xs">{{ $p->category }}</span></p>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold text-amber-900">Rp {{ number_format($p->price, 0, ',', '.') }}</p>
                                    <p class="text-sm text-gray-500"><i class="fas fa-cube mr-1"></i>Stok: {{ $p->stock }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="flex flex-col items-center justify-center text-gray-400 h-64">
                    <i class="fas fa-inbox text-6xl mb-4 opacity-50"></i>
                    <p class="text-lg">Belum ada produk</p>
                </div>
            @endif
        </div>
    </div>
</div>

@endsection