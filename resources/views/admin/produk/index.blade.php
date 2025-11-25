@extends('layouts.app')

@section('content')

<div class="flex justify-between items-center mb-6">
    <div>
        <h2 class="text-2xl font-bold text-amber-900">Manajemen Produk</h2>
        <p class="text-sm text-gray-600">Lihat dan kelola produk Batik</p>
    </div>

    <a href="{{ route('produk.create') }}" 
       class="px-4 py-2 bg-amber-600 hover:bg-amber-700 text-white rounded shadow">
       + Tambah Produk
    </a>
</div>

<div class="bg-white shadow border border-amber-200 rounded-lg overflow-hidden">

    <div class="p-4 border-b bg-amber-50">
        <input type="text" placeholder="Cari produk..."
               class="w-full px-3 py-2 border rounded outline-none focus:border-amber-600"
               onkeyup="window.location='?cari='+this.value"
               value="{{ request('cari') }}">
    </div>

    <table class="min-w-full text-left">
        <thead class="bg-amber-100">
            <tr class="text-amber-900 text-sm uppercase">
                <th class="p-3">Kode</th>
                <th class="p-3">Nama</th>
                <th class="p-3">Kategori</th>
                <th class="p-3">Harga</th>
                <th class="p-3">Stok</th>
                <th class="p-3 text-center">Aksi</th>
            </tr>
        </thead>

        <tbody class="text-gray-700">
            @forelse ($produk as $p)
            <tr class="border-b hover:bg-amber-50">
                <td class="p-3"><span class="text-xs font-bold bg-gray-200 px-2 py-1 rounded">{{ $p->code }}</span></td>
                <td class="p-3 font-medium">{{ $p->name }}</td>
                <td class="p-3">
                    @if($p->category == 'Batik Tulis')
                        <span class="px-2 py-1 text-xs rounded bg-blue-500 text-white">{{ $p->category }}</span>
                    @elseif($p->category == 'Batik Cap')
                        <span class="px-2 py-1 text-xs rounded bg-green-500 text-white">{{ $p->category }}</span>
                    @else
                        <span class="px-2 py-1 text-xs rounded bg-yellow-500 text-white">{{ $p->category }}</span>
                    @endif
                </td>
                <td class="p-3">Rp {{ number_format($p->price, 0, ',', '.') }}</td>
                <td class="p-3">{{ $p->stock }}</td>
                <td class="p-3 text-center">

                    <a href="{{ route('produk.edit', $p->id) }}" 
                       class="px-3 py-1 bg-yellow-500 hover:bg-yellow-600 text-white rounded text-sm mr-1">
                        Edit
                    </a>

                    <form action="{{ route('produk.destroy', $p->id) }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white rounded text-sm"
                                onclick="return confirm('Hapus produk ini?')">
                            Hapus
                        </button>
                    </form>

                </td>
            </tr>

            @empty
            <tr>
                <td colspan="6" class="text-center p-4 text-gray-500">Tidak ada produk ditemukan</td>
            </tr>
            @endforelse
        </tbody>
    </table>

</div>

<div class="mt-4">
    {{ $produk->links() }}
</div>

@endsection
