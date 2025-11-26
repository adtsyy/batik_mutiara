@extends('layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <h1 class="text-2xl font-bold mb-6 text-amber-900">Tambah Kasir</h1>

    <form action="{{ route('cashiers.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block font-medium mb-2">Nama Kasir</label>
            <input type="text" name="nama" 
                   class="w-full border rounded-md px-3 py-2"
                   placeholder="Masukkan nama kasir" required>
        </div>

        <div class="mb-4">
            <label class="block font-medium mb-2">Username</label>
            <input type="text" name="username" 
                   class="w-full border rounded-md px-3 py-2"
                   placeholder="Masukkan username" required>
        </div>

        <div class="mb-4">
            <label class="block font-medium mb-2">Password</label>
            <input type="password" name="password" 
                   class="w-full border rounded-md px-3 py-2"
                   placeholder="Minimal 4 karakter" required>
        </div>

        <div class="flex justify-end gap-3">
            <a href="{{ route('cashiers.index') }}" 
               class="px-4 py-2 rounded-lg bg-gray-300 hover:bg-gray-400">
                Kembali
            </a>

            <button type="submit" 
                    class="px-4 py-2 rounded-lg bg-amber-900 text-white hover:bg-amber-700">
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection
