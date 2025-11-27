@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-semibold text-[#8B4A0B]">Manajemen Kasir</h1>
<p class="text-gray-600 mt-1">Kelola data kasir dan hak akses</p>

<!-- Tombol Tambah Kasir -->
<div class="flex justify-end mt-4">
    <button onclick="openModal()" 
            class="bg-[#8B4A0B] text-white px-4 py-2 rounded-lg hover:bg-[#723d09] flex items-center space-x-2">
        <i data-feather="plus" class="w-4"></i>
        <span>Tambah Kasir</span>
    </button>
</div>

<div class="bg-white shadow-lg rounded-xl p-6 mt-4">

    <h2 class="text-lg font-semibold">Daftar Kasir</h2>
    <p class="text-gray-600 text-sm -mt-1 mb-4">Total {{ count($cashiers) }} kasir terdaftar</p>

    <input type="text" placeholder="Cari kasir..." 
           class="w-full p-2 border rounded-lg mb-4 bg-gray-50">

    <table class="w-full text-left text-sm">
        <thead class="text-gray-500">
            <tr>
                <th class="pb-3 w-40">Nama</th>
                <th class="pb-3 w-32">Username</th>
                <th class="pb-3 w-32">Password</th>
                <th class="pb-3 w-28 text-center">Hak Akses</th>
                <th class="pb-3 w-32">Tanggal Dibuat</th>
                <th class="pb-3 w-20 text-center">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach($cashiers as $c)
            <tr class="border-t text-[13px]">
                <td class="py-2">{{ $c->nama }}</td>
                <td class="py-2">{{ $c->username }}</td>
                <td class="py-2">{{ $c->password }}</td>

                <td class="py-2 text-center"> 
                    <span class="bg-gray-200 px-2 py-1 rounded-full text-xs">
                        Aktif
                    </span>
                </td>

                <td class="py-2">
                    {{ $c->created_at->format('d/m/Y') }}
                </td>
                <td class="py-2 text-center">
                    <div class="flex items-center justify-center space-x-2">
                        <button class="p-1.5 bg-gray-100 rounded-lg hover:bg-gray-200">
                            <i data-feather="edit" class="w-4"></i>
                        </button>
                        <button class="p-1.5 bg-gray-100 rounded-lg hover:bg-red-200">
                            <i data-feather="trash" class="w-4 text-red-600"></i>
                        </button>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

<!-- MODAL TAMBAH KASIR -->
<div id="modalTambahKasir" 
     class="fixed inset-0 bg-black/40 backdrop-blur-sm flex items-center justify-center z-50 hidden">

    <div class="bg-white w-[520px] rounded-xl shadow-lg p-6 relative">

        <!-- Tombol Close -->
        <button onclick="closeModal()" 
                class="absolute right-4 top-4 text-gray-500 hover:text-black text-xl">×</button>

        <!-- Judul Modal -->
        <h2 class="text-xl font-semibold text-gray-800">Tambah Kasir Baru</h2>
        <p class="text-sm text-gray-500 mt-1">
            Buat akun kasir baru dengan username dan password
        </p>

        <!-- Form -->
        <form action="{{ route('cashiers.store') }}" method="POST" class="mt-5 space-y-4">
            @csrf

            <!-- Nama -->
            <div>
                <label class="text-sm font-semibold text-gray-700">Nama Lengkap</label>
                <input type="text" name="nama"
                       class="w-full mt-1 h-9 px-3 border border-gray-300 rounded-lg 
                              focus:ring-2 focus:ring-[#8B4A0B] bg-gray-100">
            </div>

            <!-- Username -->
            <div>
                <label class="text-sm font-semibold text-gray-700">Username</label>
                <input type="text" name="username"
                       class="w-full mt-1 h-9 px-3 border border-gray-300 rounded-lg 
                              focus:ring-2 focus:ring-[#8B4A0B] bg-gray-100">
            </div>

            <!-- Password -->
            <div>
                <label class="text-sm font-semibold text-gray-700">Password</label>
                <input type="password" name="password"
                       class="w-full mt-1 h-9 px-3 border border-gray-300 rounded-lg 
                              focus:ring-2 focus:ring-[#8B4A0B] bg-gray-100">
            </div>

            <!-- Hak Akses -->
            <div class="border border-gray-300 rounded-lg bg-gray-100 px-3 py-3 w-full flex justify-center">
                <div class="flex items-center space-x-2 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5 text-gray-700 mx-auto"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 11c1.657 0 3-1.343 3-3S13.657 5 12 5 9 6.343 9 8s1.343 3 3 3z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 20v-1a6 6 0 1112 0v1"/>
                    </svg>

                    <span class="text-sm font-medium text-gray-700 text-center">
                        Kelola Hak Akses
                    </span>
                </div>
            </div>



            <!-- Tombol Submit -->
            <div class="flex justify-end space-x-3 mt-4">
                <button type="button" onclick="closeModal()"
                        class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100">
                    Batal
                </button>

                <button type="submit"
                        class="px-6 py-2 rounded-lg text-white font-medium bg-[#8B4A0B] hover:bg-[#713c09]">
                    Tambah Kasir
                </button>
            </div>

        </form>
    </div>
</div>

<script>
    function openModal() {
        document.getElementById('modalTambahKasir').classList.remove('hidden');
    }
    function closeModal() {
        document.getElementById('modalTambahKasir').classList.add('hidden');
    }
</script>

@endsection
