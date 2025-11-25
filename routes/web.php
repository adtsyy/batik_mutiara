<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\admin\DashboardController;
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
Route::get('/dashboard_admin', function () {
    return view('dashboard_admin');
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
