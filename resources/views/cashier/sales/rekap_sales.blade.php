@extends('layouts.app')

@section('content')

@include('layouts.cashier-navbar')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white p-8 rounded-lg shadow-lg border border-gray-200">
        <h2 class="text-3xl font-bold mb-2 text-gray-800">Rekap Penjualan Saya</h2>
        <p class="text-gray-600 mb-8">Transaksi penjualan yang telah diinput</p>

        <!-- STATS CARDS -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-gradient-to-br from-blue-50 to-blue-100 border-2 border-blue-200 p-6 rounded-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 font-semibold">Total Transaksi</p>
                        <p class="text-4xl font-bold text-blue-900 mt-2">{{ $sales ? $sales->count() : 0 }}</p>
                    </div>
                    <i class="fas fa-receipt text-5xl text-blue-200"></i>
                </div>
            </div>

            <div class="bg-gradient-to-br from-green-50 to-green-100 border-2 border-green-200 p-6 rounded-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 font-semibold">Total Pendapatan</p>
                        <p class="text-3xl font-bold text-green-900 mt-2">Rp {{ number_format($sales ? $sales->sum('total') : 0, 0, ',', '.') }}</p>
                    </div>
                    <i class="fas fa-money-bill-wave text-5xl text-green-200"></i>
                </div>
            </div>

            <div class="bg-gradient-to-br from-purple-50 to-purple-100 border-2 border-purple-200 p-6 rounded-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 font-semibold">Rata-rata Transaksi</p>
                        <p class="text-3xl font-bold text-purple-900 mt-2">Rp {{ number_format($sales && $sales->count() > 0 ? $sales->sum('total') / $sales->count() : 0, 0, ',', '.') }}</p>
                    </div>
                    <i class="fas fa-chart-line text-5xl text-purple-200"></i>
                </div>
            </div>
        </div>

        <!-- TABEL TRANSAKSI -->
        @if($sales && $sales->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-sm border-collapse">
                    <thead>
                        <tr class="bg-gray-800 text-white">
                            <th class="px-6 py-4 text-left font-bold">No. Invoice</th>
                            <th class="px-6 py-4 text-left font-bold">Produk</th>
                            <th class="px-6 py-4 text-right font-bold">Total</th>
                            <th class="px-6 py-4 text-center font-bold">Metode</th>
                            <th class="px-6 py-4 text-left font-bold">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sales as $sale)
                            <tr class="border-b hover:bg-gray-50 transition">
                                <td class="px-6 py-4 font-mono font-bold text-blue-600">{{ $sale->invoiceNumber }}</td>
                                <td class="px-6 py-4">
                                    @if($sale->products)
                                        <span class="bg-amber-100 text-amber-800 px-3 py-1 rounded-full text-xs font-semibold">
                                            {{ json_decode($sale->products, true)[0]['name'] ?? 'Produk' }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right font-bold text-green-700">Rp {{ number_format($sale->total, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 text-center">
                                    <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-semibold">{{ $sale->paymentMethod }}</span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $sale->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="flex flex-col items-center justify-center py-16">
                <i class="fas fa-inbox text-6xl text-gray-300 mb-4"></i>
                <p class="text-2xl text-gray-500">Belum ada transaksi</p>
            </div>
        @endif
    </div>
</div>

@endsection