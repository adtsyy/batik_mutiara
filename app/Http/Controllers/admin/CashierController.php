<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\Cashier;
use Illuminate\Http\Request;

class CashierController extends Controller
{
    public function index()
    {
        $cashiers = Cashier::all();
        return view('admin.cashiers.index', compact('cashiers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:cashiers',
            'password' => 'required|min:4',
        ]);

        Cashier::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => $request->password, // bisa pakai bcrypt($request->password)
            'status' => strtolower($request->status ?? 'aktif'),
            'akses'  => $request->akses ?? '[]',
        ]);

        return redirect()->route('cashiers.index')
                         ->with('success', 'Kasir baru berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $cashier = Cashier::findOrFail($id);

        $cashier->name = $request->name;
        $cashier->username = $request->username;

        // Update password hanya jika diisi
        if ($request->password) {
            $cashier->password = $request->password; // bisa pakai bcrypt($request->password)
        }

        // Status selalu lowercase agar konsisten
        $cashier->status = strtolower($request->status ?? $cashier->status);

        // Update hak akses
        $cashier->akses = $request->akses ?? $cashier->akses;

        $cashier->save();

        return redirect()->route('cashiers.index')
                         ->with('success', 'Data kasir berhasil diupdate.');
    }

    public function destroy($id)
    {
        Cashier::destroy($id);
        return redirect()->route('cashiers.index')
                         ->with('success', 'Kasir berhasil dihapus.');
    }
}