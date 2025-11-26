@extends('layouts.app')

@section('content')

<div class="flex justify-between items-center mb-6">
    <div>
        <h2 class="text-2xl font-bold text-amber-900">Manajemen Kasir</h2>
        <p class="text-sm text-gray-600">Lihat dan kelola akun kasir</p>
    </div>

    <a href="{{ route('cashiers.create') }}" 
        class="px-4 py-2 bg-amber-600 hover:bg-amber-700 text-white rounded shadow">
        + Tambah Kasir
    </a>
</div>

<div class="bg-white shadow border border-amber-200 rounded-lg overflow-hidden">

    {{-- Search --}}
    <div class="p-4 border-b bg-amber-50">
        <input type="text" placeholder="Cari kasir..."
            class="w-full px-3 py-2 border rounded outline-none focus:border-amber-600"
            onkeyup="window.location='?cari='+this.value"
            value="{{ request('cari') }}">
    </div>

    <table class="min-w-full text-left">
        <thead class="bg-amber-100">
            <tr class="text-amber-900 text-sm uppercase">
                <th class="p-3">ID Kasir</th>
                <th class="p-3">Nama</th>
                <th class="p-3">Username</th>
                <th class="p-3">Status</th>
                <th class="p-3">Tanggal Dibuat</th>
                <th class="p-3 text-center">Aksi</th>
            </tr>
        </thead>

        <tbody class="text-gray-700">
            @forelse ($cashiers as $kasir)
            <tr class="border-b hover:bg-amber-50">
                <td class="p-3 font-medium">{{ $kasir->id_kasir }}</td>
                <td class="p-3 font-medium">{{ $kasir->nama }}</td>
                <td class="p-3">{{ $kasir->username }}</td>
                <td class="p-3">
                    <span class="px-2 py-1 text-xs rounded 
                        {{ $kasir->status == 'Aktif' ? 'bg-green-500' : 'bg-red-500' }} 
                        text-white">
                        {{ $kasir->status }}
                    </span>
                </td>
                <td class="p-3">{{ $kasir->created_at->format('d/m/Y') }}</td>

                <td class="p-3 text-center flex gap-2 justify-center">

                    <a href="{{ route('cashiers.edit', $kasir->id) }}" 
                        class="px-3 py-1 bg-yellow-500 hover:bg-yellow-600 text-white rounded text-sm">
                        Edit
                    </a>

                    <form action="{{ route('cashiers.destroy', $kasir->id) }}" method="POST" 
                          onsubmit="return confirm('Hapus kasir ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white rounded text-sm">
                            Hapus
                        </button>
                    </form>

                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center p-4 text-gray-500">Tidak ada kasir ditemukan</td>
            </tr>
            @endforelse
        </tbody>
    </table>

</div>

@endsection
