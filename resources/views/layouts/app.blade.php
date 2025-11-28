<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Administrator Panel' }}</title>

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
                <p class="text-xs opacity-90 -mt-1">Administrator Panel</p>
            </div>
        </div>

        <div class="flex items-center space-x-4">
            <div class="text-right leading-tight">
                <p class="text-sm font-semibold">Administrator</p>
                <p class="text-xs opacity-80 -mt-1">Administrator</p>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="bg-white text-[#8B4A0B] px-4 py-1.5 rounded-lg font-medium hover:bg-gray-200 transition flex items-center space-x-1">
                    <i data-feather="log-out" class="w-4"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </nav>

    {{-- ====================== NAV MENU (RATA KIRI) ====================== --}}
    <div class="mt-6 px-10">
        <div class="bg-white shadow rounded-full px-10 py-3 w-fit flex space-x-12">

            <a href="{{ route('dashboard') }}"
            class="flex items-center space-x-2 text-gray-800 hover:text-[#8B4A0B] font-medium">
                <i data-feather="grid" class="w-5"></i>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('cashiers.index') }}"
            class="flex items-center space-x-2 text-gray-800 hover:text-[#8B4A0B] font-medium">
                <i data-feather="user" class="w-5"></i>
                <span>Kasir</span>
            </a>

            <a href="#"
            class="flex items-center space-x-2 text-gray-800 hover:text-[#8B4A0B] font-medium">
                <i data-feather="box" class="w-5"></i>
                <span>Produk</span>
            </a>

            <a href="#"
            class="flex items-center space-x-2 text-gray-800 hover:text-[#8B4A0B] font-medium">
                <i data-feather="shopping-cart" class="w-5"></i>
                <span>Penjualan</span>
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
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT BATIK MUTIARA</title>

    <!-- TAILWIND -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-yellow-50 font-sans">

    <!-- NAVBAR -->
    <nav class="bg-amber-900 text-white shadow-md">
        <div class="max-w-screen-xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-4">
                <img src="/logo.png" class="w-12 h-12" alt="Logo">
                <div>
                    <div class="font-bold text-lg">PT BATIK MUTIARA</div>
                    <div class="text-xs">Administrator Panel</div>
                </div>
            </div>

            <div class="flex items-center gap-8">
                <div class="flex gap-6">
                    <a href="/admin/dashboard" class="hover:text-amber-300">Dashboard</a>
                    <a href="/admin/cashiers" class="hover:text-amber-300">Kasir</a>
                    <a href="/admin/products" class="hover:text-amber-300">Produk</a>
                    <a href="/admin/sales" class="hover:text-amber-300">Penjualan</a>
                </div>

                <div class="flex items-center gap-2">
                    <span>Administrator</span>
                    <button class="px-3 py-1 rounded-md bg-white text-amber-900 hover:bg-gray-200">Logout</button>
                </div>
            </div>
        </div>
    </nav>

    <!-- CONTENT -->
    <main class="max-w-screen-xl mx-auto px-6 py-6">
        @yield('content')
    </main>

</body>
</html>
