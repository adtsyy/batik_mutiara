@extends('layouts.app')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard Admin')

@section('content')
<div class="grid gap-5 md:grid-cols-2 lg:grid-cols-4 mb-6">

    <!-- Pendapatan Hari Ini -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex justify-between items-start">
            <div>
                <div class="text-sm text-gray-600">Pendapatan Hari Ini</div>
                <div class="text-2xl font-semibold text-gray-900 mt-3">
                    {{ 'Rp ' . number_format($todayRevenue, 0, ',', '.') }}
                </div>
                <div class="text-xs text-gray-500 mt-1">{{ $todayTransactions ?? 0 }} transaksi</div>
            </div>
            <div class="bg-green-50 p-2 rounded-full">
                <span style="color:#16a34a;">💵</span>
            </div>
        </div>
    </div>

    <!-- Pendapatan Bulan Ini -->
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

    <!-- Pendapatan Tahun Ini -->
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

    <!-- Total Transaksi -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex justify-between items-start">
            <div>
                <div class="text-sm text-gray-600">Total Transaksi</div>
                <div class="text-2xl font-semibold text-gray-900 mt-3">
                    {{ $totalSales }}
                </div>
                <div class="text-xs text-gray-500 mt-1">Semua transaksi</div>
            </div>
            <div class="bg-amber-50 p-2 rounded-full">
                <span style="color:#c2410c;">📊</span>
            </div>
        </div>
    </div>

</div>

<!-- Transaksi Terbaru Full Width -->
<div class="bg-white rounded-lg shadow w-full">
    <div class="p-6 border-b">
        <h3 class="text-lg font-semibold">Transaksi Terbaru</h3>
        <p class="text-sm text-gray-500">5 transaksi terakhir</p>
    </div>

    <div class="p-6">
        @forelse($recentSales as $sale)
            <div class="flex flex-col sm:flex-row sm:justify-between items-start sm:items-center border-b py-4 last:border-b-0">
                <div>
                    <div class="font-medium">{{ $sale->invoiceNumber }}</div>
                    <div class="text-xs text-gray-500 mt-1">
                        {{ $sale->cashierName }} • 
                        {{ \Carbon\Carbon::parse($sale->created_at)->translatedFormat('d/m/Y, H:i') }}
                    </div>
                </div>

                <div class="text-right mt-2 sm:mt-0">
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
@endsection
