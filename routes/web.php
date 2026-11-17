<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirect()->route('login'));

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/laporan', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/laporan/cetak', [ReportController::class, 'print'])->name('reports.print');

    Route::middleware(['role:admin,bendahara'])->group(function () {
        Route::get('/transaksi/{type}', [TransactionController::class, 'index'])->name('transactions.index');
        Route::post('/transaksi/{type}', [TransactionController::class, 'store'])->name('transactions.store');
        Route::delete('/transaksi/{transaction}', [TransactionController::class, 'destroy'])->name('transactions.destroy');
    });

    Route::middleware(['role:admin'])->group(function () {
        Route::resource('kategori', CategoryController::class);
        Route::resource('anggaran', BudgetController::class);
        Route::resource('pengguna', UserController::class);
    });
});
