@extends('layouts.app')

@section('content')

@include('layouts.cashier-navbar')

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
        <!-- LEFT : Pilih Produk -->
        <div class="bg-white p-6 rounded-lg shadow-lg border border-gray-200">
            <h2 class="text-2xl font-bold mb-2 text-gray-800">Pilih Produk</h2>
            <p class="text-gray-600 mb-6">Tambahkan produk ke keranjang belanja</p>

            <form action="{{ route('cashier.sales.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label class="block text-sm font-semibold mb-2 text-gray-700">Produk</label>
                    <select name="product_id" class="w-full border-2 border-gray-300 rounded-lg px-4 py-2 focus:border-amber-900 focus:outline-none transition" required>
                        <option value="">-- Pilih produk --</option>
                        @if($products && $products->count() > 0)
                            @foreach ($products as $p)
                                <option value="{{ $p->id }}">
                                    {{ $p->name }} - Rp {{ number_format($p->price, 0, ',', '.') }} (Stok: {{ $p->stock }})
                                </option>
                            @endforeach
                        @else
                            <option disabled>Produk tidak tersedia</option>
                        @endif
                    </select>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-semibold mb-2 text-gray-700">Jumlah</label>
                    <input type="number" name="qty" value="1" min="1" max="999"
                        class="w-full border-2 border-gray-300 rounded-lg px-4 py-2 focus:border-amber-900 focus:outline-none transition" required>
                </div>

                <button type="submit" class="w-full bg-amber-900 hover:bg-amber-800 text-white font-bold py-3 rounded-lg flex items-center justify-center gap-2 transition">
                    <i class="fas fa-plus"></i> Tambah ke Keranjang
                </button>
            </form>
        </div>

        <!-- RIGHT : Keranjang -->
        <div class="bg-white p-6 rounded-lg shadow-lg border border-gray-200">
            <h2 class="text-2xl font-bold mb-2 text-gray-800">Keranjang</h2>
            <p class="text-gray-500 mb-6">0 item</p>

            <div class="flex flex-col items-center justify-center text-gray-400 h-64">
                <i class="fas fa-shopping-bag text-6xl mb-4 opacity-50"></i>
                <p class="text-lg">Keranjang masih kosong</p>
            </div>
        </div>
    </div>
</div>

@endsection