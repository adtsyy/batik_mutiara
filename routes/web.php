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
Route::prefix('cashier')->group(function () {
    // Dashboard Kasir
    Route::get('/', function () {
        $products = Product::all();
        $sales = \App\Models\Sale::all();
        return view('cashier.index', compact('products', 'sales'));
    })->name('cashier.index');

    // Input Produk Kasir
    Route::get('/product/cru_produk', function () {
        $products = Product::all();
        return view('cashier.produk.cru_produk', compact('products'));
    })->name('cashier.product.cru_produk');

    Route::post('/product/store', [ProductController::class, 'store'])
        ->name('cashier.product.store');

    // Input Penjualan Kasir
    Route::get('/sales/create', function () {
        $products = Product::all();
        return view('cashier.sales.create', compact('products'));
    })->name('cashier.sales.create');

    Route::post('/sales/store', [SaleController::class, 'store'])
        ->name('cashier.sales.store');

    // Rekap Penjualan Kasir
    Route::get('/sales/rekap_sales', function () {
        $sales = \App\Models\Sale::all();
        return view('cashier.sales.rekap_sales', compact('sales'));
    })->name('cashier.sales.rekap_sales');
});

// AUTH ROUTES
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ======================= SALES TAMBAHAN =======================
Route::post('/sales/add', [SaleController::class, 'add'])->name('sales.add');

