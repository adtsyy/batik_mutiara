<!DOCTYPE html>
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
