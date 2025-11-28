<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sale;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $sales = Sale::orderBy('created_at', 'desc')->get();
        $now = Carbon::now();

        // Batas waktu
        $todayStart = $now->copy()->startOfDay();
        $monthStart = $now->copy()->startOfMonth();
        $yearStart  = $now->copy()->startOfYear();

        // Pendapatan
        $todayRevenue = $sales->where('created_at', '>=', $todayStart)->sum('total');
        $monthRevenue = $sales->where('created_at', '>=', $monthStart)->sum('total');
        $yearRevenue  = $sales->where('created_at', '>=', $yearStart)->sum('total');

        // Jumlah transaksi
        $todayTransactions = $sales->where('created_at', '>=', $todayStart)->count();
        $totalSales = $sales->count();

        // Transaksi terbaru
        $recentSales = $sales->take(5);

        // Gunakan totalSales untuk dashboard
        return view('admin.sales.dashboard', compact(
            'todayRevenue',
            'monthRevenue',
            'yearRevenue',
            'todayTransactions',
            'totalSales',
            'recentSales'
        ));
    }
}
