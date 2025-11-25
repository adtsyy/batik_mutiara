<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sale;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // ambil semua sale (atau batasi sesuai tenant/branch jika perlu)
        $sales = Sale::orderBy('created_at', 'desc')->get();

        $now = Carbon::now();

        $todayStart = $now->copy()->startOfDay();
        $monthStart = $now->copy()->startOfMonth();
        $yearStart  = $now->copy()->startOfYear();

        // Hitung pendapatan
        $todayRevenue = $sales->filter(fn($s) => Carbon::parse($s->created_at)->greaterThanOrEqualTo($todayStart))
                               ->sum('total');

        $monthRevenue = $sales->filter(fn($s) => Carbon::parse($s->created_at)->greaterThanOrEqualTo($monthStart))
                               ->sum('total');

        $yearRevenue = $sales->filter(fn($s) => Carbon::parse($s->created_at)->greaterThanOrEqualTo($yearStart))
                             ->sum('total');

        $todayTransactions = $sales->filter(fn($s) => Carbon::parse($s->created_at)->greaterThanOrEqualTo($todayStart))->count();

        $recentSales = $sales->take(5); // 5 transaksi terbaru (sudah di-orderBy)

        return view('admin.dashboard', compact(
            'todayRevenue',
            'monthRevenue',
            'yearRevenue',
            'todayTransactions',
            'recentSales',
            'sales'
        ));
    }
}
