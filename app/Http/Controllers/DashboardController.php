<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Budget;

class DashboardController extends Controller
{
    public function index()
    {
        $currentMonth = now()->month;
        $currentYear = now()->year;

        $totalPemasukan = Transaction::where('type', 'pemasukan')->sum('amount');
        $totalPengeluaran = Transaction::where('type', 'pengeluaran')->sum('amount');
        $saldoKas = $totalPemasukan - $totalPengeluaran;

        $pemasukanBulanIni = Transaction::where('type', 'pemasukan')
            ->whereMonth('transaction_date', $currentMonth)
            ->whereYear('transaction_date', $currentYear)
            ->sum('amount');

        $pengeluaranBulanIni = Transaction::where('type', 'pengeluaran')
            ->whereMonth('transaction_date', $currentMonth)
            ->whereYear('transaction_date', $currentYear)
            ->sum('amount');

        $totalAnggaranTahunIni = Budget::where('year', $currentYear)->sum('allocated_amount');

        $recentTransactions = Transaction::with(['category', 'user'])
            ->latest('transaction_date')
            ->take(7)
            ->get();

        return view('dashboard.index', compact(
            'totalPemasukan',
            'totalPengeluaran',
            'saldoKas',
            'pemasukanBulanIni',
            'pengeluaranBulanIni',
            'totalAnggaranTahunIni',
            'recentTransactions'
        ));
    }
}
