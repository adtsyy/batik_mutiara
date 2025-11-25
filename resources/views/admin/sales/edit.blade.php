@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 shadow rounded">

    <h2 class="text-2xl font-bold mb-4">Edit Transaksi</h2>

    <form method="POST" action="{{ route('sales.update', $sale->id) }}">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label>No Invoice</label>
                <input type="text" name="invoiceNumber"
                       value="{{ $sale->invoiceNumber }}" class="border rounded px-3 py-2 w-full">
            </div>

            <div>
                <label>Kasir</label>
                <select name="cashierId" class="border rounded px-3 py-2 w-full">
                    @foreach($cashiers as $c)
                    <option value="{{ $c->id }}" {{ $c->id == $sale->cashierId ? 'selected' : '' }}>
                        {{ $c->name }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mt-4">
            <label>Metode Pembayaran</label>
            <select name="paymentMethod" class="border rounded px-3 py-2 w-full">
                @foreach(['Cash','Transfer','E-Wallet','Debit Card','Credit Card'] as $method)
                <option value="{{ $method }}" {{ $sale->paymentMethod==$method?'selected':'' }}>
                    {{ $method }}
                </option>
                @endforeach
            </select>
        </div>

        <h3 class="font-semibold mt-6">Produk</h3>

        <table class="w-full border mt-2" id="productTable">
            <thead class="bg-gray-100">
                <tr>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Qty</th>
                    <th>Subtotal</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($sale->products as $i => $p)
                <tr>
                    <td>
                        <select name="products[{{ $i }}][productId]" class="border rounded px-2 py-1 w-full">
                            @foreach($products as $prod)
                            <option value="{{ $prod->id }}" {{ $p['productId']==$prod->id?'selected':'' }}>
                                {{ $prod->name }}
                            </option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input type="number" name="products[{{ $i }}][price]"
                               value="{{ $p['price'] }}"
                               class="border px-2 py-1 w-24 price-input">
                    </td>
                    <td>
                        <input type="number" name="products[{{ $i }}][quantity]"
                               value="{{ $p['quantity'] }}"
                               class="border px-2 py-1 w-20 qty-input">
                    </td>
                    <td class="subtotal text-green-600">
                        Rp {{ number_format($p['subtotal'],0,',','.') }}
                    </td>
                    <td>
                        <button type="button" class="text-red-600 remove-row">Hapus</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <button
            type="button"
            id="addRow"
            class="mt-3 px-3 py-1 bg-gray-200 rounded">
            + Tambah Produk
        </button>

        <div class="flex justify-between mt-6 text-xl font-bold">
            <span>Total</span>
            <span id="grandTotal" class="text-green-600">
                Rp {{ number_format($sale->total,0,',','.') }}
            </span>
        </div>

        <button class="mt-6 bg-blue-600 text-white px-6 py-2 rounded">
            Simpan Perubahan
        </button>
    </form>
</div>

<script>
document.addEventListener("input", updateTotals);
document.querySelectorAll(".remove-row").forEach(btn=>{
    btn.onclick=function(){ btn.closest("tr").remove(); updateTotals(); }
});

function updateTotals(){
    let total = 0;
    document.querySelectorAll("#productTable tbody tr").forEach(row=>{
        let price = parseFloat(row.querySelector(".price-input").value) || 0;
        let qty = parseInt(row.querySelector(".qty-input").value) || 0;
        let sub = price * qty;
        row.querySelector(".subtotal").innerText = "Rp " + sub.toLocaleString("id-ID");
        total += sub;
    });
    document.querySelector("#grandTotal").innerText = "Rp " + total.toLocaleString("id-ID");
}
</script>
@endsection
