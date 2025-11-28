<!-- filepath: d:\vscode\batik_mutiara\resources\views\layouts\cashier-navbar.blade.php -->
<nav class="bg-gradient-to-r from-amber-900 to-amber-800 shadow-lg text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo & Title -->
            <div class="flex items-center gap-4">
                <img src="/logo.png" class="w-10 h-10 sm:w-12 sm:h-12" alt="Logo">
                <div>
                    <div class="font-bold text-lg">PT BATIK MUTIARA</div>
                    <div class="text-xs">Cashier Panel</div>
                </div>
            </div>

            <!-- Desktop Navigation Links -->
            <div class="hidden md:flex items-center gap-1">
                <a href="{{ route('cashier.sales.create') }}" 
                    class="px-4 py-2 rounded-lg text-white hover:bg-amber-700 transition {{ request()->routeIs('cashier.sales.create') ? 'bg-amber-700' : '' }}">
                    <i class="fas fa-shopping-cart mr-2"></i>Input Penjualan
                </a>

                <a href="{{ route('cashier.product.cru_produk') }}" 
                    class="px-4 py-2 rounded-lg text-white hover:bg-amber-700 transition {{ request()->routeIs('cashier.product.cru_produk') ? 'bg-amber-700' : '' }}">
                    <i class="fas fa-box mr-2"></i>Input Produk
                </a>

                <a href="{{ route('cashier.sales.rekap_sales') }}" 
                    class="px-4 py-2 rounded-lg text-white hover:bg-amber-700 transition {{ request()->routeIs('cashier.sales.rekap_sales') ? 'bg-amber-700' : '' }}">
                    <i class="fas fa-receipt mr-2"></i>Rekap Penjualan
                </a>
            </div>

            <!-- Right Side (desktop) -->
            <div class="hidden md:flex items-center gap-3">
                <!-- Kasir text, vertically centered and aligned to the left of the button -->
                <div class="flex flex-col items-end justify-center">
                    <span class="text-white text-sm font-semibold leading-none">Kasir</span>
                    <span class="text-amber-100 text-xs leading-none">PT Batik Mutiara</span>
                </div>

                <!-- Logout button -->
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit"
                        class="inline-flex items-center justify-center gap-2 bg-white text-amber-900 border border-amber-900 hover:bg-amber-900 hover:text-white px-3 py-1.5 rounded-md transition-colors duration-150 text-sm leading-none">
                        <i class="fas fa-sign-out-alt"></i>
                        <span class="ml-1">Logout</span>
                    </button>
                </form>
            </div>

            <!-- Mobile Hamburger Button -->
            <div class="md:hidden flex items-center">
                <button id="mobile-menu-button" aria-expanded="false" aria-controls="mobile-menu"
                    class="p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-amber-300">
                    <svg id="icon-open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg id="icon-close" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu (hidden by default) -->
        <div id="mobile-menu" class="md:hidden hidden border-t border-amber-700">
            <div class="px-4 py-3 space-y-1">
                <a href="{{ route('cashier.sales.create') }}" 
                   class="block w-full text-left px-3 py-2 rounded-md text-white hover:bg-amber-700 transition {{ request()->routeIs('cashier.sales.create') ? 'bg-amber-700' : '' }}">
                    <i class="fas fa-shopping-cart mr-2"></i> Input Penjualan
                </a>

                <a href="{{ route('cashier.product.cru_produk') }}" 
                   class="block w-full text-left px-3 py-2 rounded-md text-white hover:bg-amber-700 transition {{ request()->routeIs('cashier.product.cru_produk') ? 'bg-amber-700' : '' }}">
                    <i class="fas fa-box mr-2"></i> Input Produk
                </a>

                <a href="{{ route('cashier.sales.rekap_sales') }}" 
                   class="block w-full text-left px-3 py-2 rounded-md text-white hover:bg-amber-700 transition {{ request()->routeIs('cashier.sales.rekap_sales') ? 'bg-amber-700' : '' }}">
                    <i class="fas fa-receipt mr-2"></i> Rekap Penjualan
                </a>

                <div class="pt-2 border-t border-amber-700">
                    <div class="mt-2 text-white px-3">
                        <p class="text-sm font-semibold">Kasir</p>
                        <p class="text-xs text-amber-100">PT Batik Mutiara</p>
                    </div>

                    <form action="{{ route('logout') }}" method="POST" class="px-3 py-3">
                        @csrf
                        <button type="submit"
                            class="w-full inline-flex items-center justify-center gap-2 bg-white text-amber-900 border border-amber-900 hover:bg-amber-900 hover:text-white px-3 py-1.5 rounded-md transition-colors duration-150 text-sm leading-none">
                            <i class="fas fa-sign-out-alt"></i>
                            <span class="ml-1">Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>

<script>
    (function(){
        const btn = document.getElementById('mobile-menu-button');
        const menu = document.getElementById('mobile-menu');
        const iconOpen = document.getElementById('icon-open');
        const iconClose = document.getElementById('icon-close');

        if (!btn || !menu) return;

        btn.addEventListener('click', function(){
            const isHidden = menu.classList.toggle('hidden');
            // update aria
            const expanded = btn.getAttribute('aria-expanded') === 'true';
            btn.setAttribute('aria-expanded', (!expanded).toString());
            // toggle icons
            iconOpen.classList.toggle('hidden');
            iconClose.classList.toggle('hidden');
        });

        // close menu on resize to desktop
        window.addEventListener('resize', function(){
            if (window.innerWidth >= 768) {
                if (!menu.classList.contains('hidden')) {
                    menu.classList.add('hidden');
                    iconOpen.classList.remove('hidden');
                    iconClose.classList.add('hidden');
                    btn.setAttribute('aria-expanded', 'false');
                }
            }
        });
    })();
</script>