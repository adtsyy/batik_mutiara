<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\CashierController;
use App\Http\Controllers\ProductController;

Route::get('/admin/dashboard', [DashboardController::class, 'index'])
    ->name('admin.dashboard');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard_kasir', function () {
    return view('dashboard_kasir');
});

// Sales Routes
Route::get('/admin/sales', [SaleController::class, 'index'])->name('sales.index');
Route::get('/admin/sales/{sale}', [SaleController::class, 'show'])->name('sales.show');
Route::get('/admin/sales/{sale}/edit', [SaleController::class, 'edit'])->name('sales.edit');
Route::put('/admin/sales/{sale}', [SaleController::class, 'update'])->name('sales.update');

// Dashboard Admin
Route::get('/dashboard_admin', function () {
    return view('dashboard_admin');
});

// Cashiers Routes
Route::prefix('admin')->group(function () {
Route::get('/cashiers', [CashierController::class, 'index'])->name('cashiers.index');
Route::post('/cashiers', [CashierController::class, 'store'])->name('cashiers.store');
Route::put('/cashiers/{id}', [CashierController::class, 'update'])->name('cashiers.update');
Route::delete('/cashiers/{id}', [CashierController::class, 'destroy'])->name('cashiers.destroy');
});

//kasir_cru_penjualan
Route::get('/cashier', function () {
    return view('cashier.index');
});

// crud produk
Route::resource('/produk', ProductController::class)->names([
    'index' => 'produk.index',
    'create' => 'produk.create',
    'store' => 'produk.store',
    'edit' => 'produk.edit',
    'update' => 'produk.update',
    'destroy' => 'produk.destroy',
]);

Route::prefix('admin')->group(function () {
    Route::resource('products', ProductController::class);
});
