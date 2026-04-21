<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggota;
use App\Models\Resit;
use App\Models\Bayaran;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {

        $totalAhli = Anggota::count();
        $totalBayaran = Bayaran::sum('jumlah');
        $totalResit = Resit::count();
        
        $bayaranBulanIni = Bayaran::whereMonth('created_at', Carbon::now()->month)
        ->whereYear('created_at', Carbon::now()->year)
        ->sum('jumlah');

        $selectedYear = $request->year ?? date('Y');
        $months = [];
        $amounts = [];

        $raw = Bayaran::selectRaw('MONTH(created_at) as month, SUM(jumlah) as total')
        ->whereYear('created_at', $selectedYear)
        ->groupBy('month')
        ->pluck('total', 'month');

        for ($i = 1; $i <= 12; $i++) {
            $months[] = date('M', mktime(0, 0, 0, $i, 1));
            $amounts[] = $raw[$i] ?? 0;
        }


        $topAhli = Bayaran::select('anggota_id')
        ->selectRaw('SUM(jumlah) as total_bayaran')
        ->with('anggota')
        ->groupBy('anggota_id')
        ->orderByDesc('total_bayaran')
        ->limit(5)
        ->get();


        return view('dashboard.index', compact(
            'totalAhli', 
            'totalBayaran', 
            'totalResit', 
            'bayaranBulanIni',
            'months',
            'amounts',
            'selectedYear',
            'topAhli'
        ));
    }
}
