@extends('layouts.app')

@section('content')

<h1 style="font-size:28px; font-weight:bold; color:#5a3210">Manajemen Penjualan</h1>
<p style="color:#777; margin-top:-5px">Lihat dan kelola data penjualan</p>

<div class="card" style="margin-top:20px; padding:20px; border-radius:12px; background:#fff;">

    <h3 style="margin:0;">Daftar Penjualan</h3>
    <p style="color:#777; margin-top:4px">Total {{ count($sales) }} transaksi</p>

    <form method="GET" style="margin:15px 0;">
        <input type="text" name="search" value="{{ request('search') }}"
               placeholder="Cari transaksi…"
               style="width:100%; padding:12px; border-radius:8px; border:1px solid #ddd;">
    </form>

    {{-- ------------------ TABEL ------------------ --}}
    <table style="width:100%; border-collapse:collapse; margin-top:10px;">
        <thead>
            <tr style="background:#f5f5f5; text-align:left;">
                <th style="padding:14px;">No. Invoice</th>
                <th style="padding:14px;">Kasir</th>
                <th style="padding:14px;">Total</th>
                <th style="padding:14px;">Pembayaran</th>
                <th style="padding:14px;">Tanggal</th>
                <th style="padding:14px; text-align:center;">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($sales as $sale)
            <tr style="border-bottom:1px solid #eee;">
                <td style="padding:14px;"><strong>{{ $sale->invoiceNumber }}</strong></td>

                <td style="padding:14px;">{{ $sale->cashierName }}</td>

                <td style="padding:14px; color:green; font-weight:bold;">
                    Rp {{ number_format($sale->total, 0, ',', '.') }}
                </td>

                <td style="padding:14px;">
                    <span style="
                        background:#ececec;
                        padding:4px 10px;
                        border-radius:6px;
                        font-size:12px;">
                        {{ $sale->paymentMethod }}
                    </span>
                </td>

                <td style="padding:14px;">
                    {{ $sale->created_at->format('d/m/Y, H.i.s') }}
                </td>

                <td style="padding:14px; text-align:center;">
                    <a href="{{ route('sales.show', $sale->id) }}"
                       style="margin-right:5px; text-decoration:none;">
                        <button style="
                            width:36px; height:36px; border-radius:8px;
                            border:1px solid #ddd; background:#fff;
                            cursor:pointer;">
                            👁
                        </button>
                    </a>

                    <a href="{{ route('sales.edit', $sale->id) }}"
                       style="text-decoration:none;">
                        <button style="
                            width:36px; height:36px; border-radius:8px;
                            border:1px solid #ddd; background:#fff;
                            cursor:pointer;">
                            ✏️
                        </button>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

@endsection
