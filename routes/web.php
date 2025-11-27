<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CashierController;

// Redirect dari root ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// Halaman Login
Route::get('/login', [AuthController::class, 'loginPage'])->name('login');

// Proses Login
Route::post('/login', [AuthController::class, 'loginSubmit'])->name('login.submit');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/cashiers', [CashierController::class, 'index'])->name('cashiers.index');
    Route::post('/cashiers', [CashierController::class, 'store'])->name('cashiers.store');
    Route::put('/cashiers/{id}', [CashierController::class, 'update'])->name('cashiers.update');
    Route::delete('/cashiers/{id}', [CashierController::class, 'destroy'])->name('cashiers.destroy');
});
