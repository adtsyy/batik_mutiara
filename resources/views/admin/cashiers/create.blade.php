@extends('layouts.app')

@section('content')
<div class="bg-white shadow rounded p-6">
    <h1 class="text-2xl font-bold mb-4 text-amber-900">Tambah Kasir</h1>

    <form action="{{ route('cashiers.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="font-medium">Nama Kasir</label>
            <input type="text" name="nama" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="font-medium">Username</label>
            <input type="text" name="username" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="font-medium">Password</label>
            <input type="password" name="password" class="w-full border rounded px-3 py-2" required>
        </div>

        <button class="px-4 py-2 bg-amber-900 text-white rounded">Simpan</button>
    </form>
</div>
@endsection
