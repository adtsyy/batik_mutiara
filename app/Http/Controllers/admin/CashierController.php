<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cashier;
use Illuminate\Http\Request;

class CashierController extends Controller
{
    public function index()
    {
        $cashiers = Cashier::orderBy('created_at', 'asc')->get();
        return view('admin.cashiers.index', compact('cashiers'));
    }

    // FORM TAMBAH KASIR
    public function create()
    {
        return view('admin.cashiers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'username' => 'required|unique:cashiers',
            'password' => 'required|min:4',
        ]);

        Cashier::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'status' => 'Aktif',
        ]);

        return redirect()->route('cashiers.index')->with('success', 'Kasir berhasil ditambahkan');
    }

    // FORM EDIT KASIR
    public function edit($id)
    {
        $cashier = Cashier::findOrFail($id);
        return view('admin.cashiers.edit', compact('cashier'));
    }

    public function update(Request $request, $id)
    {
        $cashier = Cashier::findOrFail($id);

        $cashier->update([
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => $request->password ? bcrypt($request->password) : $cashier->password,
            'status' => $request->status,
        ]);

        return redirect()->route('cashiers.index')->with('success', 'Data kasir berhasil diperbarui');
    }

    public function destroy($id)
    {
        Cashier::destroy($id);
        return redirect()->route('cashiers.index')->with('success', 'Kasir berhasil dihapus');
    }
}
