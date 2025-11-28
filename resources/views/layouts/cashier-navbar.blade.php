<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Cashier Panel' }}</title>

    {{-- TAILWIND CDN (NO VITE) --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Feather Icons --}}
    <script src="https://unpkg.com/feather-icons"></script>

    <style>
        body {
            background: #FFFBEF;
        }
    </style>
</head>

<body>

    {{-- ====================== TOP NAVBAR COKLAT ====================== --}}
    <nav class="bg-[#8B4A0B] text-white px-10 py-3 flex items-center justify-between shadow-lg">

        <div class="flex items-center space-x-4">
            <img src="/logo.png" class="w-14 h-14 rounded-full border border-white shadow">
            <div>
                <h1 class="text-xl font-semibold">PT BATIK MUTIARA</h1>
                <p class="text-xs opacity-90 -mt-1">Cashier Panel</p>
            </div>
        </div>

        <div class="flex items-center space-x-4">
            <div class="text-right leading-tight">
                <p class="text-sm font-semibold">Cashier</p>
                <p class="text-xs opacity-80 -mt-1">Cashier</p>
            </div>

            {{-- <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="bg-white text-[#8B4A0B] px-4 py-1.5 rounded-lg font-medium hover:bg-gray-200 transition flex items-center space-x-1">
                    <i data-feather="log-out" class="w-4"></i>
                    <span>Logout</span>
                </button>
            </form> --}}
        </div>
    </nav>

    {{-- ====================== NAV MENU (RATA KIRI) ====================== --}}
    <div class="mt-6 px-10">
        <div class="bg-white shadow rounded-full px-10 py-3 w-fit flex space-x-12">

            <a href="{{ route('cashier.sales.create') }}"
            class="flex items-center space-x-2 text-gray-800 hover:text-[#8B4A0B] font-medium transition {{request()->routeIs('cashier.sales.create') ? 'font-bold' : ''}}">
                <i data-feather="shopping-cart" class="w-5"></i>
                <span>Input Penjualan</span>
            </a>

            <a href="{{ route('cashier.product.cru_produk') }}"
            class="flex items-center space-x-2 text-gray-800 hover:text-[#8B4A0B] font-medium">
            <i data-feather="box" class="w-5"></i>
            <span>Input Produk</span>
            </a>

            <a href="{{ route('cashier.sales.rekap_sales') }}"
                class="flex items-center space-x-2 text-gray-800 hover:text-[#8B4A0B] font-medium">
                <i data-feather="grid" class="w-5"></i>
                <span>Rekap Penjualan</span>
            </a>

        </div>
    </div>


    {{-- ====================== PAGE CONTENT ====================== --}}
    <div class="px-10 mt-8 mb-10">
        @yield('content')
    </div>

    <script>
        feather.replace();
    </script>

</body>
</html>