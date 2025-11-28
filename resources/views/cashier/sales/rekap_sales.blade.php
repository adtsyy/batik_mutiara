@extends('layouts.cashier-navbar')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<div class="grid grid-cols-1 md:grid-cols-2 gap-8">

    <!-- LEFT : Pilih Produk -->
    <div class="bg-white p-6 rounded-lg shadow border border-gray-200">
        <h2 class="text-xl font-semibold mb-2">Pilih Produk</h2>
        <p class="text-gray-600 mb-4">Tambahkan produk ke keranjang</p>

        <form action="{{ route('cashier.sales.rekap_sales') }}" method="POST">
            @csrf

            {{-- <label class="block text-sm mb-1">Produk</label>
            <select name="product_id"
                class="w-full border rounded px-3 py-2 mb-4">
                <option value="">Pilih produk...</option>

                @foreach ($products as $p)
                    <option value="{{ $p->id }}">{{ $p->name }}</option>
                @endforeach
            </select> --}}

            <label class="block text-sm mb-1">Jumlah</label>
            <input type="number" name="qty" value="1"
                class="w-full border rounded px-3 py-2 mb-4">

            <button class="bg-black text-white px-4 py-2 rounded-lg w-full flex items-center justify-center gap-2">
                <span>+</span> Tambah ke Keranjang
            </button>
        </form>
    </div>

    <!-- RIGHT : Keranjang -->
    <div class="bg-white p-6 rounded-lg shadow border border-gray-200">
        <h2 class="text-xl font-semibold">Keranjang</h2>
        <p class="text-gray-500 mb-4">0 item</p>

        <div class="flex flex-col items-center justify-center text-gray-400 h-48">
            <i class="fas fa-shopping-bag text-4xl mb-2"></i>
            Keranjang masih kosong
        </div>
    </div>

</div>


@endsection