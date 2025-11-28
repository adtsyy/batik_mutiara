<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CashierController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\CashierController;
use App\Http\Controllers\ProductController;
use Symfony\Component\Routing\Route as RoutingRoute;
use App\Models\Product;

Route::get('/admin/dashboard', [DashboardController::class, 'index'])
    ->name('admin.dashboard');

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


// crud produk
// admin crud produk
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

// kasir cru produk

// Halaman input produk kasir
Route::get('/kasir/produk', [ProductController::class, 'create'])->name('kasir.produk.create');

// Proses submit produk kasir tetap menggunakan store yg sama
Route::post('/kasir/produk', [ProductController::class, 'store'])->name('kasir.produk.store');

// Menampilkan produk terbaru (opsional)
Route::get('/kasir/produk/terbaru', [ProductController::class, 'index'])->name('kasir.produk.index');

Route::get('/sales', [SaleController::class, 'index']);
Route::post('/sales/add', [SaleController::class, 'add'])->name('sales.add');

// use App\Http\Controllers\cashier\SaleController
// Route::prefix('kasir')->middleware(['checkrole:kasir'])->group(function(){
// Route::get('/penjualan', [SaleController::class,'index'])->name('cashier.index');
// Route::get('/penjualan/create', [SaleController::class,'create'])->name('cashier.sales.create');
// Route::post('/penjualan/store', [SaleController::class,'store'])->name('casier.sales.store');
// });


//kasir_cru_penjualan
Route::get('/cashier', function () {
    return view('cashier.index');
});

Route::get('/cashier/sales/create', function () {
    $products = Product::all();
    return view('cashier.sales.create', compact('products'));
})->name('cashier.sales.create');

Route::get('/cashier/product/cru_produk', function () {
    $products = Product::all();
    return view('cashier.product.cru_produk', compact('products'));
})->name('cashier.product.cru_produk');

Route::get('/cashier/sales/rekap_sales', function () {
    $products = Product::all();
    return view('cashier.sales.rekap_sales', compact('products'));
})->name('cashier.sales.rekap_sales');

