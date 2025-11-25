@extends('layouts.app')

@section('content')
<div class="max-w-screen-xl mx-auto px-6 py-6">

    <div>
        <h1 class="text-3xl font-semibold text-amber-900 mb-1">Dashboard</h1>
        <p class="text-gray-600 mb-6">Ringkasan pendapatan dan penjualan</p>
    </div>

    <!-- Cards grid -->
    <div class="grid gap-5 md:grid-cols-2 lg:grid-cols-4 mb-6">

        <!-- CARD — Pendapatan Hari Ini -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex justify-between items-start">
                <div>
                    <div class="text-sm text-gray-600">Pendapatan Hari Ini</div>
                    <div class="text-2xl font-semibold text-gray-900 mt-3">
                        {{ 'Rp ' . number_format($todayRevenue, 0, ',', '.') }}
                    </div>
                    <div class="text-xs text-gray-500 mt-1">{{ $todayTransactions }} transaksi</div>
                </div>
                <div class="bg-green-50 p-2 rounded-full">
                    <span style="color:#16a34a;">💵</span>
                </div>
            </div>
        </div>

        <!-- CARD — Pendapatan Bulan Ini -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex justify-between items-start">
                <div>
                    <div class="text-sm text-gray-600">Pendapatan Bulan Ini</div>
                    <div class="text-2xl font-semibold text-gray-900 mt-3">
                        {{ 'Rp ' . number_format($monthRevenue, 0, ',', '.') }}
                    </div>
                    <div class="text-xs text-gray-500 mt-1">
                        {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('F Y') }}
                    </div>
                </div>
                <div class="bg-blue-50 p-2 rounded-full">
                    <span style="color:#2563eb;">📈</span>
                </div>
            </div>
        </div>

        <!-- CARD — Pendapatan Tahun Ini -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex justify-between items-start">
                <div>
                    <div class="text-sm text-gray-600">Pendapatan Tahun Ini</div>
                    <div class="text-2xl font-semibold text-gray-900 mt-3">
                        {{ 'Rp ' . number_format($yearRevenue, 0, ',', '.') }}
                    </div>
                    <div class="text-xs text-gray-500 mt-1">
                        {{ \Carbon\Carbon::now()->year }}
                    </div>
                </div>
                <div class="bg-purple-50 p-2 rounded-full">
                    <span style="color:#7c3aed;">📅</span>
                </div>
            </div>
        </div>

        <!-- CARD — Total Transaksi -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex justify-between items-start">
                <div>
                    <div class="text-sm text-gray-600">Total Transaksi</div>
                    <div class="text-2xl font-semibold text-gray-900 mt-3">
                        {{ $sales->count() }}
                    </div>
                    <div class="text-xs text-gray-500 mt-1">Semua transaksi</div>
                </div>
                <div class="bg-amber-50 p-2 rounded-full">
                    <span style="color:#c2410c;">🛍️</span>
                </div>
            </div>
        </div>

    </div>

    <!-- Transaksi Terbaru -->
    <div class="bg-white rounded-lg shadow">
        <div class="p-6 border-b">
            <h3 class="text-lg font-semibold">Transaksi Terbaru</h3>
            <p class="text-sm text-gray-500">5 transaksi terakhir</p>
        </div>

        <div class="p-6">
            @forelse($recentSales as $sale)
                <div class="flex items-center justify-between border-b py-4 last:border-b-0">
                    <div>
                        <div class="font-medium">{{ $sale->invoiceNumber }}</div>
                        <div class="text-xs text-gray-500 mt-1">
                            {{ $sale->cashierName }} • 
                            {{ \Carbon\Carbon::parse($sale->created_at)
                                    ->translatedFormat('d/m/Y, H:i') }}
                        </div>
                    </div>

                    <div class="text-right">
                        <div class="text-sm font-semibold text-green-600">
                            {{ 'Rp ' . number_format($sale->total, 0, ',', '.') }}
                        </div>
                        <div class="text-xs text-gray-500 mt-1">{{ $sale->paymentMethod }}</div>
                    </div>
                </div>
            @empty
                <div class="py-6 text-center text-gray-500">Belum ada transaksi</div>
            @endforelse
        </div>
    </div>

</div>
@endsection
