@extends('layout.app')

@section('content')
<div class="container py-4">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5>Tambah Produk Baru</h5>
                    <p>Input data produk batik baru</p>

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('kasir.product.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label>Kode Produk</label>
                                <input name="kode_produk" class="form-control" placeholder="BTK001">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>Kategori</label>
                                <input name="kategori" class="form-control" placeholder="Batik Tulis">
                            </div>
                        </div>

                        <div class="mb-2">
                            <label>Nama Produk</label>
                            <input name="nama_produk" class="form-control" placeholder="Batik Tulis Parang">
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label>Harga (Rp)</label>
                                <input name="harga" class="form-control" placeholder="350000">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>Stok</label>
                                <input name="stok" class="form-control" placeholder="25">
                            </div>
                        </div>

                        <button class="btn btn-warning text-white w-100 mt-3">+ Tambah Produk</button>

                    </form>
                </div>
            </div>

            <div class="card shadow-sm mt-4">
                <div class="card-body">
                    <h5>Produk Terbaru</h5>
                    <p>5 produk terakhir yang ditambahkan</p>

                    @foreach($products as $p)
                        <div class="d-flex justify-content-between border-bottom py-2">
                            <div>
                                <strong>{{ $p->nama_produk }}</strong><br>
                                <small>{{ $p->kode_produk }} - {{ $p->kategori }}</small>
                            </div>
                            <div class="text-end">
                                Rp {{ number_format($p->harga) }}<br>
                                <small>Stock: {{ $p->stok }}</small>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>

        </div>
    </div>

</div>
@endsection
