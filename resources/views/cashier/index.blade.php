@extends('layouts.app')

@section('content')

<div class="max-w-2xl mx-auto mb-6">
            <div class="grid grid-cols-3 bg-white border border-amber-200 rounded-lg overflow-hidden">

                <button onclick="switchTab('sales')"
                    id="tab-sales"
                    class="py-3 flex items-center justify-center gap-2 hover:bg-amber-100 font-medium">
                    <i class="fas fa-shopping-cart"></i> Input Penjualan
                </button>

                <button onclick="switchTab('products')"
                    id="tab-products"
                    class="py-3 flex items-center justify-center gap-2 hover:bg-amber-100 font-medium">
                    <i class="fas fa-box"></i> Input Produk
                </button>

                <button onclick="switchTab('recap')"
                    id="tab-recap"
                    class="py-3 flex items-center justify-center gap-2 hover:bg-amber-100 font-medium">
                    <i class="fas fa-receipt"></i> Rekap Penjualan
                </button>
            </div>
        </div>

        {{-- <!-- TAB CONTENT -->
        <div id="content-sales">@include('cashier.sections.sales')</div>
        <div id="content-products" class="hidden">@include('cashier.sections.products')</div>
        <div id="content-recap" class="hidden">@include('cashier.sections.recap')</div> --}}

    <!-- Tab Switch Script -->
    {{-- <script>
        function switchTab(tab) {
            document.getElementById('content-sales').classList.add('hidden')
            document.getElementById('content-products').classList.add('hidden')
            document.getElementById('content-recap').classList.add('hidden')

            document.getElementById(`content-${tab}`).classList.remove('hidden')
        }
    </script> --}}

@endsection