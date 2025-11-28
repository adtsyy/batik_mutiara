@extends('layouts.cashier-navbar')

@section('content')

<style>
    .tab-content.hidden {
        display: none !important;
    }
    .tab-btn.active {
        background-color: #78350f;
        color: white;
    }
</style>

<div class="container-fluid mt-4">
    <!-- TAB BUTTONS -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="btn-group w-100" role="group">
                <button type="button" 
                    class="btn btn-outline-warning flex-fill tab-btn active" 
                    onclick="switchTab('create', this)"
                    id="btn-create">
                    <i class="fas fa-shopping-cart"></i> Input Penjualan
                </button>

                <button type="button" 
                    class="btn btn-outline-warning flex-fill tab-btn" 
                    onclick="switchTab('products', this)"
                    id="btn-products">
                    <i class="fas fa-box"></i> Input Produk
                </button>

                <button type="button" 
                    class="btn btn-outline-warning flex-fill tab-btn" 
                    onclick="switchTab('recap', this)"
                    id="btn-recap">
                    <i class="fas fa-receipt"></i> Rekap Penjualan
                </button>
            </div>
        </div>
    </div>

    <!-- TAB CONTENT -->
    <div id="content-create" class="tab-content">
        @include('cashier.sales.create', compact('products'))
    </div>

    <div id="content-products" class="tab-content hidden">
        @include('cashier.produk.cru_produk', compact('products'))
    </div>

    <div id="content-recap" class="tab-content hidden">
        @include('cashier.sales.rekap_sales', compact('sales'))
    </div>
</div>

<!-- Tab Switch Script -->
<script>
    function switchTab(tab, buttonElement) {
        // Hide semua content
        document.querySelectorAll('.tab-content').forEach(el => {
            el.classList.add('hidden');
        });

        // Show yang dipilih
        document.getElementById(`content-${tab}`).classList.remove('hidden');

        // Update button styling
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.classList.remove('active');
        });
        buttonElement.classList.add('active');
    }
</script>

@endsection