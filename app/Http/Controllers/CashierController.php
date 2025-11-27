<?php

namespace App\Http\Controllers;

use App\Models\Cashier;
use Illuminate\Http\Request;

class CashierController extends Controller
{
    public function index()
    {
        $cashiers = Cashier::all();
        return view('cashiers.index', compact('cashiers'));
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
            'password' => $request->password, // bisa pakai bcrypt jika diperlukan
            'status' => 'Aktif',
        ]);

        return redirect()->route('cashiers.index');
    }

    public function update(Request $request, $id)
    {
        $cashier = Cashier::findOrFail($id);

        $cashier->update([
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => $request->password,
            'status' => $request->status,
        ]);

        return redirect()->route('cashiers.index');
    }

    public function destroy($id)
    {
        Cashier::destroy($id);
        return redirect()->route('cashiers.index');
    }
}
