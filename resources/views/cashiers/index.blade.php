@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-semibold text-[#8B4A0B]">Manajemen Kasir</h1>
<p class="text-gray-600 mt-1">Kelola data kasir dan hak akses</p>

<div class="flex justify-end mt-4">
    <button class="bg-[#8B4A0B] text-white px-4 py-2 rounded-lg hover:bg-[#723d09] flex items-center space-x-2">
        <i data-feather="plus" class="w-4"></i>
        <span>Tambah Kasir</span>
    </button>
</div>

<div class="bg-white shadow-lg rounded-xl p-6 mt-4">

    <h2 class="text-lg font-semibold">Daftar Kasir</h2>
    <p class="text-gray-600 text-sm -mt-1 mb-4">Total {{ count($cashiers) }} kasir terdaftar</p>

    <input type="text" placeholder="Cari kasir..." 
           class="w-full p-2 border rounded-lg mb-4 bg-gray-50">

    <table class="w-full text-left">
        <thead class="text-gray-500">
            <tr>
                <th class="pb-3">Nama</th>
                <th class="pb-3">Username</th>
                <th class="pb-3">Password</th>
                <th class="pb-3">Status</th>
                <th class="pb-3">Tanggal Dibuat</th>
                <th class="pb-3 text-center">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach($cashiers as $c)
            <tr class="border-t">
                <td class="py-3">{{ $c->nama }}</td>
                <td>{{ $c->username }}</td>
                <td>{{ $c->password }}</td>
                <td>
                    <span class="bg-gray-200 px-3 py-1 rounded-full text-sm">Aktif</span>
                </td>
                <td>{{ $c->created_at->format('d/m/Y') }}</td>

                <td class="flex items-center justify-center space-x-3 mt-2">
                    <button class="p-2 bg-gray-100 rounded-lg hover:bg-gray-200">
                        <i data-feather="edit" class="w-4"></i>
                    </button>
                    <button class="p-2 bg-gray-100 rounded-lg hover:bg-red-200">
                        <i data-feather="trash" class="w-4 text-red-600"></i>
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

@endsection
