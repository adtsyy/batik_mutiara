<?php

namespace App\Http\Controllers\admin;

use App\Models\Cashier;
use Illuminate\Http\Request;

class CashierController 
{
    public function index()
    {
        $cashiers = Cashier::all();
        return view('cashiers.index', compact('cashiers'));
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
            'password' => $request->password, // bisa pakai bcrypt jika diperlukan
            'status' => 'Aktif',
        ]);

        return redirect()->route('cashiers.index');
    }

    public function update(Request $request, $id)
    {
        $cashier = Cashier::findOrFail($id);

        $cashier->update([
            'name' => $request->name,
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
