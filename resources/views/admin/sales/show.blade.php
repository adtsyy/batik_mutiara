@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white rounded shadow p-6 space-y-4">

    <h2 class="text-2xl font-bold">Detail Transaksi</h2>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <strong>No Invoice</strong>
            <p>{{ $sale->invoiceNumber }}</p>
        </div>
        <div>
            <strong>Kasir</strong>
            <p>{{ $sale->cashierName }}</p>
        </div>
        <div>
            <strong>Metode Pembayaran</strong>
            <p>{{ $sale->paymentMethod }}</p>
        </div>
        <div>
            <strong>Tanggal</strong>
            <p>{{ $sale->created_at->format('d/m/Y H:i') }}</p>
        </div>
    </div>

    <h3 class="text-xl font-semibold mt-4">Produk</h3>

    <table class="w-full border">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-2">Nama Produk</th>
                <th>Harga</th>
                <th>Qty</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sale->products as $p)
            <tr class="border-b">
                <td class="p-2">{{ $p['productName'] }}</td>
                <td>Rp {{ number_format($p['price'], 0, ',', '.') }}</td>
                <td>{{ $p['quantity'] }}</td>
                <td>Rp {{ number_format($p['subtotal'], 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="flex justify-between text-xl font-bold pt-4">
        <span>Total</span>
        <span class="text-green-600">Rp {{ number_format($sale->total, 0, ',', '.') }}</span>
    </div>

</div>
@endsection
