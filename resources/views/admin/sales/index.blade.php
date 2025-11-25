@extends('layouts.app')

@section('content')

<h1 style="font-size:28px; font-weight:bold; color:#5a3210">Manajemen Penjualan</h1>
<p style="color:#777; margin-top:-5px">Lihat dan kelola data penjualan</p>

<div class="card" style="margin-top:20px;">

    <h3 style="margin:0;">Daftar Penjualan</h3>
    <p style="color:#777; margin-top:4px">Total {{ count($sales) }} transaksi</p>

    <form method="GET" style="margin:15px 0;">
        <input type="text" name="search" value="{{ request('search') }}"
               placeholder="Cari transaksi…" 
               style="width:100%; padding:12px; border-radius:8px; border:1px solid #ddd;">
    </form>

    <table>
        <thead>
            <tr>
                <th>No. Invoice</th>
                <th>Kasir</th>
                <th>Total</th>
                <th>Pembayaran</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($sales as $sale)
            <tr>
                <td><strong>{{ $sale->invoiceNumber }}</strong></td>
                <td>{{ $sale->cashierName }}</td>
                <td style="color:green; font-weight:bold;">Rp {{ number_format($sale->total, 0, ',', '.') }}</td>
                <td><span class="badge">{{ $sale->paymentMethod }}</span></td>
                <td>{{ $sale->created_at->format('d/m/Y, H.i.s') }}</td>
                <td>
                    <a href="{{ route('sales.show', $sale->id) }}">
                        <button class="btn-icon">👁</button>
                    </a>
                    <a href="{{ route('sales.edit', $sale->id) }}">
                        <button class="btn-icon">✏️</button>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

@endsection
