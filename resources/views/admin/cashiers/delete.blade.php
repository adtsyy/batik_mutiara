@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <h4 class="fw-bold">Hapus Kasir</h4>
    <p>Apakah Anda yakin ingin menghapus kasir <b>{{ $cashier->nama }}</b>?</p>

    <div class="card shadow-sm p-4">
        <form action="{{ route('cashiers.destroy', $cashier->id) }}" method="POST">
            @csrf
            @method('DELETE')

            <button class="btn btn-danger">Hapus</button>
            <a href="{{ route('cashiers.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>

</div>
@endsection
