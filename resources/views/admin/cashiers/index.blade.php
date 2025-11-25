@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <h3 class="fw-bold mb-1">Manajemen Kasir</h3>
    <p class="text-muted">Kelola data kasir dan hak akses</p>

    <!-- Header + Tambah -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h5 class="fw-semibold">Daftar Kasir</h5>
            <span class="text-muted">Total {{ $cashiers->count() }} kasir terdaftar</span>
        </div>

        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
            + Tambah Kasir
        </button>
    </div>

    <!-- Search -->
    <input type="text" class="form-control mb-3" placeholder="Cari kasir...">

    <!-- Table -->
    <div class="card shadow-sm p-3">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Status</th>
                    <th>Tanggal Dibuat</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach($cashiers as $cashier)
                <tr>
                    <td>{{ $cashier->nama }}</td>
                    <td>{{ $cashier->username }}</td>
                    <td><span class="badge bg-light text-dark">******</span></td>
                    <td>
                        <span class="badge bg-success">{{ $cashier->status }}</span>
                    </td>
                    <td>{{ $cashier->created_at->format('d/m/Y') }}</td>

                    <td>
                        <button class="btn btn-sm btn-outline-dark" data-bs-toggle="modal" data-bs-target="#modalEdit{{$cashier->id}}">
                            ✏️
                        </button>

                        <form action="{{ route('cashiers.destroy', $cashier->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">🗑️</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</div>

{{-- MODAL TAMBAH --}}
<div class="modal fade" id="modalTambah">
    <div class="modal-dialog">
        <form class="modal-content" method="POST" action="{{ route('cashiers.store') }}">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Tambah Kasir</h5>
            </div>

            <div class="modal-body">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control" required>

                <label class="mt-2">Username</label>
                <input type="text" name="username" class="form-control" required>

                <label class="mt-2">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

@endsection
