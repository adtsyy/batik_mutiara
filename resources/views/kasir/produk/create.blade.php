@extends('layouts.app') {{-- sesuaikan dengan layout kamu --}}

@section('content')
<div class="container py-4">

    <div class="row justify-content-center">
        <div class="col-md-8">

            {{-- FORM TAMBAH PRODUK --}}
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="fw-bold mb-1">Tambah Produk Baru</h5>
                    <small class="text-muted">Input data produk batik baru</small>

                    {{-- ALERT SUCCESS --}}
                    @if(session('success'))
                        <div class="alert alert-success mt-3">{{ session('success') }}</div>
                    @endif

                    {{-- ALERT VALIDATION --}}
                    @if ($errors->any())
                        <div class="alert alert-danger mt-3">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('kasir.produk.store') }}" method="POST" class="mt-3">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Kode Produk</label>
                                <input type="text" name="code" class="form-control" placeholder="BTK001" value="{{ old('code') }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Kategori</label>
                                <select name="category" class="form-control">
                                    <option disabled selected>Pilih Kategori</option>
                                    <option value="Batik Tulis" {{ old('category')=='Batik Tulis'?'selected':'' }}>Batik Tulis</option>
                                    <option value="Batik Cap" {{ old('category')=='Batik Cap'?'selected':'' }}>Batik Cap</option>
                                    <option value="Batik Printing" {{ old('category')=='Batik Printing'?'selected':'' }}>Batik Printing</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Nama Produk</label>
                            <input type="text" name="name" class="form-control" placeholder="Batik Tulis Parang" value="{{ old('name') }}">
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Harga (Rp)</label>
                                <input type="number" name="price" class="form-control" placeholder="350000" value="{{ old('price') }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Stok</label>
                                <input type="number" name="stock" class="form-control" placeholder="25" value="{{ old('stock') }}">
                            </div>
                        </div>

                        <button class="btn btn-warning text-white w-100 fw-bold mt-2">+ Tambah Produk</button>
                    </form>
                </div>
            </div>

            {{-- LIST PRODUK TERBARU --}}
            <div class="card shadow-sm mt-4">
                <div class="card-body">
                    <h5 class="fw-bold mb-1">Produk Terbaru</h5>
                    <small class="text-muted">5 produk terakhir yang ditambahkan</small>

                    @foreach($produk as $p)
                        <div class="d-flex justify-content-between border-bottom py-2 mt-2">
                            <div>
                                <strong>{{ $p->name }}</strong><br>
                                <small>{{ $p->code }} - {{ $p->category }}</small>
                            </div>
                            <div class="text-end">
                                Rp {{ number_format($p->price) }}<br>
                                <small class="text-muted">Stock: {{ $p->stock }}</small>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>

        </div>
    </div>

</div>
@endsection
