@extends('layouts.app')

@section('content')
<div class="bg-white shadow rounded p-6">
    <h1 class="text-2xl font-bold mb-4 text-amber-900">Edit Kasir</h1>

    <form action="{{ route('cashiers.update', $cashier->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="font-medium">Nama Kasir</label>
            <input type="text" name="nama" class="w-full border rounded px-3 py-2" value="{{ $cashier->nama }}" required>
        </div>

        <div class="mb-4">
            <label class="font-medium">Username</label>
            <input type="text" name="username" class="w-full border rounded px-3 py-2" value="{{ $cashier->username }}" required>
        </div>

        <div class="mb-4">
            <label class="font-medium">Password (opsional)</label>
            <input type="password" name="password" class="w-full border rounded px-3 py-2">
        </div>

        <div class="mb-4">
            <label class="font-medium">Status</label>
            <select name="status" class="w-full border rounded px-3 py-2">
                <option value="Aktif" {{ $cashier->status=='Aktif'?'selected':'' }}>Aktif</option>
                <option value="Nonaktif" {{ $cashier->status=='Nonaktif'?'selected':'' }}>Nonaktif</option>
            </select>
        </div>

        <button class="px-4 py-2 bg-amber-900 text-white rounded">Simpan Perubahan</button>
    </form>
</div>
@endsection
