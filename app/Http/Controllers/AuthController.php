<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController
{
    public function loginPage() {
        return view('auth.login');
    }

    public function loginSubmit(Request $request) {
        $admin = User::where('username', $request->username)->first();

        if (!$admin || !Hash::check($request->password, $admin->password)) {
            return back()->with('error', 'Username atau password salah');
        }

        Auth::login($admin);
        return redirect('/cashiers');
    }

    public function logout() {
        Auth::logout();
        return redirect('/login');
    }
}
