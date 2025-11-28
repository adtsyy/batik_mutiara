<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\admin\CashierController;
use App\Http\Controllers\admin\SaleController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\ProductController;
use App\Models\Product;

// ======================= ADMIN ROUTES =======================
// Dashboard Admin
Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

// Manajemen Kasir
Route::resource('cashiers', CashierController::class);

// Sales Admin (tanpa create & store)
Route::resource('sales', SaleController::class)->except(['create','store']);

// Produk
// Produk
Route::prefix('admin')->name('products.')->group(function () {
    Route::get('/products', [ProductController::class, 'index'])->name('index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('create');
    Route::post('/products', [ProductController::class, 'store'])->name('store');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('destroy');
});


// ======================= DASHBOARD UMUM =======================
Route::get('/dashboard_umum', function () {
    return view('dashboard');
})->name('dashboard_umum');

// ======================= KASIR ROUTES ========================
Route::prefix('kasir')->group(function () {
    // Dashboard Kasir
    Route::get('/dashboard', function () {
        return view('dashboard_kasir');
    })->name('kasir.dashboard');

    // CRUD Produk Kasir
    Route::get('/produk', [ProductController::class, 'create'])->name('kasir.produk.create');
    Route::post('/produk', [ProductController::class, 'store'])->name('kasir.produk.store');
    Route::get('/produk/terbaru', [ProductController::class, 'index'])->name('kasir.produk.index');

    // Sales Kasir
    Route::get('/sales/create', function () {
        $products = Product::all();
        return view('cashier.sales.create', compact('products'));
    })->name('kasir.sales.create');

    Route::get('/sales/rekap', function () {
        $products = Product::all();
        return view('cashier.sales.rekap_sales', compact('products'));
    })->name('kasir.sales.rekap');
});

// ======================= SALES TAMBAHAN =======================
Route::post('/sales/add', [SaleController::class, 'add'])->name('sales.add');
