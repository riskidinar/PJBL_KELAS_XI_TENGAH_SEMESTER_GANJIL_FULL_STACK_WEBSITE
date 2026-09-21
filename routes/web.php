<?php

use App\Http\Controllers\Admin\FruitController;
use App\Http\Controllers\Admin\KasirController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Kasir\DashboardController;
use App\Http\Controllers\Kasir\HistoryController;
use App\Http\Controllers\Kasir\ScaleController;
use App\Http\Controllers\Kasir\TransactionController;
use App\Http\Controllers\LocaleController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/kasir', function () {
    return view('layouts.kasir');
})->name('kasir');

Route::get('/admin', function () {
    return view('layouts.admin');
})->name('admin');

Route::prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::view('/dashboard', 'admin.dashboard.index')->name('dashboard.index');
        Route::get('/fruits', [FruitController::class, 'index'])->name('fruits.index');
        Route::get('/fruits/create', [FruitController::class, 'create'])->name('fruits.create');
        Route::post('/fruits', [FruitController::class, 'store'])->name('fruits.store');
        Route::get('/fruits/{id}/edit', [FruitController::class, 'edit'])->name('fruits.edit');
        Route::put('/fruits/{id}', [FruitController::class, 'update'])->name('fruits.update');
        Route::delete('/fruits/{id}', [FruitController::class, 'destroy'])->name('fruits.destroy');
        Route::get('/kasir', [KasirController::class, 'index'])->name('kasir.index');
        Route::get('/kasir/create', [KasirController::class, 'create'])->name('kasir.create');
        Route::post('/kasir', [KasirController::class, 'store'])->name('kasir.store');
        Route::get('/kasir/{id}/edit', [KasirController::class, 'edit'])->name('kasir.edit');
        Route::put('/kasir/{id}', [KasirController::class, 'update'])->name('kasir.update');
        Route::delete('/kasir/{id}', [KasirController::class, 'destroy'])->name('kasir.destroy');
        Route::view('/report', 'admin.report.index')->name('report.index');
        Route::view('/history', 'admin.history.index')->name('history.index');
    });

Route::prefix('kasir')
    ->name('kasir.')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
        Route::get('/transaksi', [TransactionController::class, 'index'])->name('transaction.index');
        Route::post('/transaksi', [TransactionController::class, 'store'])->name('transaction.store');
        Route::get('/riwayat', [HistoryController::class, 'index'])->name('history.index');
        Route::get('/timbangan', [ScaleController::class, 'index'])->name('scale.index');

        Route::get('/struk/barcode/{trxId}', function (string $trxId) {
            $safeTransactionId = htmlspecialchars($trxId, ENT_XML1, 'UTF-8');
            $svg = '<svg xmlns="http://www.w3.org/2000/svg" width="240" height="64" viewBox="0 0 240 64">'
                .'<rect width="240" height="64" fill="white"/>'
                .'<path stroke="black" stroke-width="2" d="M8 8h2v48H8zM14 8h4v48h-4zM22 8h2v48h-2zM30 8h6v48h-6zM40 8h2v48h-2zM48 8h4v48h-4zM58 8h2v48h-2zM66 8h6v48h-6zM78 8h2v48h-2zM86 8h4v48h-4zM96 8h2v48h-2zM104 8h6v48h-6zM116 8h2v48h-2zM124 8h4v48h-4zM134 8h2v48h-2zM142 8h6v48h-6zM154 8h2v48h-2zM162 8h4v48h-4zM172 8h2v48h-2zM180 8h6v48h-6zM192 8h2v48h-2zM200 8h4v48h-4zM210 8h2v48h-2zM218 8h6v48h-6z"/>'
                .'<text x="120" y="62" text-anchor="middle" font-size="8" font-family="monospace">'.$safeTransactionId.'</text>'
                .'</svg>';

            return response($svg)->header('Content-Type', 'image/svg+xml');
        })->name('struct.barcode');
        Route::get('/struk/{trxId?}', function (?string $trxId = null) {
            $receipt = session('receipt');

            return view('kasir.struct.index', [
                'trxId' => $trxId ?? $receipt['trx_id'] ?? null,
                'receipt' => $receipt,
                'transaction' => $receipt ? [
                    'grand_total' => $receipt['grand_total'],
                    'tendered' => $receipt['payment_amount'],
                    'ref' => $receipt['trx_id'],
                    'datetime' => $receipt['date'].' WIB',
                    'cashier' => $receipt['cashier'],
                    'customer' => $receipt['customer'],
                ] : null,
            ]);
        })->name('struct.index');
    });

Route::post('/logout', function () {
    Auth::logout();

    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect()->route('login');
})->name('logout');

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/locale', [LocaleController::class, 'update'])
    ->name('locale.update');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.process');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');
