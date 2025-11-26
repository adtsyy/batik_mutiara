<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Cashier;
use Illuminate\Http\Request;

class CashierController extends Controller
{
    // LIST KASIR
    public function index()
    {
        $cashiers = Cashier::orderBy('created_at', 'asc')->get();
        return view('admin.cashiers.index', compact('cashiers'));
    }

    // FORM TAMBAH
    public function create()
    {
        return view('admin.cashiers.create');
    }

    // SIMPAN DATA
    public function store(Request $request)
    {
        $request->validate([
            'nama'      => 'required|string|max:255',
            'username'  => 'required|unique:cashiers,username',
            'password'  => 'required|min:4',
        ]);

        // Generate ID kasir otomatis
        $idKasir = 'KSR-' . rand(10000, 99999);

        Cashier::create([
            'id_kasir' => $idKasir,
            'nama'     => $request->nama,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'status'   => 'Aktif',
        ]);

        return redirect()->route('cashiers.index')
                         ->with('success', 'Kasir berhasil ditambahkan!');
    }

    // FORM EDIT
    public function edit($id)
    {
        $cashier = Cashier::findOrFail($id);
        return view('admin.cashiers.edit', compact('cashier'));
    }

    // UPDATE DATA
    public function update(Request $request, $id)
    {
        $cashier = Cashier::findOrFail($id);

        $request->validate([
            'nama'      => 'required',
            'username'  => 'required|unique:cashiers,username,' . $cashier->id,
        ]);

        $cashier->update([
            'nama'     => $request->nama,
            'username' => $request->username,
            'password' => $request->password
                ? bcrypt($request->password)
                : $cashier->password,
            'status'   => $request->status,
        ]);

        return redirect()->route('cashiers.index')
                         ->with('success', 'Data kasir diperbarui!');
    }

    // HAPUS DATA
    public function destroy($id)
    {
        $cashier = Cashier::findOrFail($id);
        $cashier->delete();

        return redirect()->route('cashiers.index')
                         ->with('success', 'Kasir berhasil dihapus!');
    }
}
