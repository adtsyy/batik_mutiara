<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Cashier;
use Illuminate\Http\Request;

class CashierController extends Controller
{
    // Tampilkan daftar kasir
    public function index()
    {
        $cashiers = Cashier::all();
        return view('admin.cashiers.index', compact('cashiers'));
    }

    // Simpan kasir baru
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:cashiers',
            'password' => 'required|string|min:4',
        ]);

        Cashier::create([
            'nama'     => $request->name, // request name ke kolom nama
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'status'   => $request->status ?? 'AKTIF',
        ]);

        return redirect()->route('cashiers.index')
                         ->with('success', 'Kasir baru berhasil ditambahkan.');
    }

    // Update kasir
    public function update(Request $request, $id)
    {
        $cashier = Cashier::findOrFail($id);

        $request->validate([
            'name'     => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:cashiers,username,' . $cashier->id,
            'password' => 'nullable|string|min:4',
        ]);

        $cashier->name = $request->name;
        $cashier->username = $request->username;

        if ($request->password) {
            $cashier->password = bcrypt($request->password);
        }

        $cashier->status = strtolower($request->status ?? $cashier->status);
        $cashier->akses  = $request->akses ?? $cashier->akses;

        $cashier->save();

        return redirect()->route('cashiers.index')
                         ->with('success', 'Data kasir berhasil diupdate.');
    }

    // Hapus kasir
    public function destroy($id)
    {
        Cashier::destroy($id);

        return redirect()->route('cashiers.index')
                         ->with('success', 'Kasir berhasil dihapus.');
    }
}
