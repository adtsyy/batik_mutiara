<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\CashierController;
use App\Http\Controllers\ProductController;
use App\Models\Product;

// Admin Routes
Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
Route::get('/dashboard_admin', function () {
    return view('dashboard_admin');
});

Route::prefix('admin')->group(function () {
    Route::get('/cashiers', [CashierController::class, 'index'])->name('cashiers.index');
    Route::post('/cashiers', [CashierController::class, 'store'])->name('cashiers.store');
    Route::put('/cashiers/{id}', [CashierController::class, 'update'])->name('cashiers.update');
    Route::delete('/cashiers/{id}', [CashierController::class, 'destroy'])->name('cashiers.destroy');
    Route::resource('products', ProductController::class);
});

// Sales Routes (Admin)
Route::get('/admin/sales', [SaleController::class, 'index'])->name('sales.index');
Route::get('/admin/sales/{sale}', [SaleController::class, 'show'])->name('sales.show');
Route::get('/admin/sales/{sale}/edit', [SaleController::class, 'edit'])->name('sales.edit');
Route::put('/admin/sales/{sale}', [SaleController::class, 'update'])->name('sales.update');

// Product Routes (Admin CRUD)
Route::resource('/produk', ProductController::class)->names([
    'index' => 'produk.index',
    'create' => 'produk.create',
    'store' => 'produk.store',
    'edit' => 'produk.edit',
    'update' => 'produk.update',
    'destroy' => 'produk.destroy',
]);

// ===== AUTH ROUTES =====
Route::post('/logout', function () {
    auth()->logout();
    session()->invalidate();
    session()->regenerateToken();
    return redirect('/')->with('success', 'Berhasil logout');
})->name('logout')->middleware('auth');

// ===== CASHIER ROUTES =====
Route::prefix('cashier')->group(function () {
    // Dashboard Kasir
    Route::get('/', function () {
        $products = Product::all();
        $sales = \App\Models\Sale::all();
        return view('cashier.index', compact('products', 'sales'));
    })->name('cashier.index');

    // Input Penjualan
    Route::get('/sales/create', function () {
        $products = Product::all();
        return view('cashier.sales.create', compact('products'));
    })->name('cashier.sales.create');

    Route::post('/sales/store', [SaleController::class, 'store'])
        ->name('cashier.sales.store');

    // Input Produk
    Route::get('/product/cru_produk', function () {
        $products = Product::all();
        return view('cashier.produk.cru_produk', compact('products'));
    })->name('cashier.product.cru_produk');

    Route::post('/product/store', [ProductController::class, 'store'])
        ->name('cashier.product.store');

    // Rekap Penjualan
    Route::get('/sales/rekap_sales', function () {
        $sales = \App\Models\Sale::all();
        return view('cashier.sales.rekap_sales', compact('sales'));
    })->name('cashier.sales.rekap_sales');
});

// ===== PUBLIC ROUTES =====
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard_kasir', function () {
    return view('dashboard_kasir');
});

// Legacy routes (untuk kompatibilitas)
Route::get('/sales', [SaleController::class, 'index']);
Route::post('/sales/add', [SaleController::class, 'add'])->name('sales.add');

