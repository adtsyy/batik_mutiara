@extends('layouts.app')

@section('content')

@include('cashier.navbar')

<div class="container mt-4">

    <!-- TAB MENU -->
    <div class="text-center mb-4">
        <div class="btn-group">
            <a href="/kasir/input-penjualan" class="btn btn-outline-secondary">🧾 Input Penjualan</a>
            <a href="/kasir/input-produk" class="btn btn-warning text-dark fw-bold">📦 Input Produk</a>
            <a href="/kasir/rekap-penjualan" class="btn btn-outline-secondary">📊 Rekap Penjualan</a>
        </div>
    </div>

    <div class="row justify-content-center">
        
        <!-- FORM INPUT PRODUK -->
        <div class="col-md-6">
            <div class="card shadow-sm p-3">
                <h5 class="fw-bold">Tambah Produk Baru</h5>
                <small class="text-muted">Input data produk batik baru</small>

                <form action="{{ route('kasir.store-produk') }}" method="POST" class="mt-3">
                    @csrf

                    <div class="row mb-3">
                        <div class="col">
                            <label>Kode Produk</label>
                            <input type="text" name="kode" class="form-control" required>
                        </div>

                        <div class="col">
                            <label>Kategori</label>
                            <input type="text" name="kategori" class="form-control" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label>Nama Produk</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>

                    <div class="row mb-4">
                        <div class="col">
                            <label>Harga (Rp)</label>
                            <input type="number" name="harga" class="form-control" required>
                        </div>

                        <div class="col">
                            <label>Stok</label>
                            <input type="number" name="stok" class="form-control" required>
                        </div>
                    </div>

                    <button class="btn w-100 text-light" style="background:#74340D;">
                        + Tambah Produk
                    </button>
                </form>
            </div>
        </div>

        <!-- PRODUK TERBARU -->
        <div class="col-md-6 mt-4 mt-md-0">
            <div class="card shadow-sm p-3">

                <h5 class="fw-bold">Produk Terbaru</h5>
                <small class="text-muted">5 produk terakhir yang ditambahkan</small>

                <hr>

                @foreach ($produkTerbaru as $p)
                <div class="d-flex justify-content-between mb-3">
                    <div>
                        <strong>{{ $p->nama }}</strong><br>
                        <small>{{ $p->kode }} - {{ $p->kategori }}</small>
                    </div>
                    <div class="text-end">
                        <strong>Rp {{ number_format($p->harga, 0, ',', '.') }}</strong><br>
                        <small>Stok: {{ $p->stok }}</small>
                    </div>
                </div>
                @endforeach

            </div>
        </div>

    </div>

</div>

@endsection
