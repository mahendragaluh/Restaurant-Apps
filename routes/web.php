<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MasakanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return redirect('login');
});

Auth::routes();
Route::middleware('auth')->group(function() {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resource('pengguna', UserController::class)->middleware(['role.admin','role.waiter','role.kasir']);
    Route::resource('masakan', MasakanController::class)->middleware(['role.admin']);

    Route::middleware(['role.kasir', 'role.waiter','role.admin', 'role.owner'])->group(function() {
        Route::prefix('laporan')->group(function() {
            Route::get('/', [App\Http\Controllers\LaporanController::class, 'index'])->name('laporan.index');
        });
    });

    Route::middleware(['role.kasir','role.admin'])->group(function() {
        Route::prefix('transaksi')->group(function() {
            Route::get('/', [App\Http\Controllers\TransactionController::class, 'index'])->name('transaksi.index');
            Route::get('/{id}', [App\Http\Controllers\TransactionController::class, 'show'])->name('transaksi.show');
            Route::post('/finish/{id}', [App\Http\Controllers\TransactionController::class, 'finish'])->name('transaksi.finish');
        });
    });

    Route::middleware(['role.pelanggan', 'role.waiter','role.admin'])->group(function() {
        Route::prefix('order')->group(function() {
            Route::get('/', [App\Http\Controllers\OrderController::class, 'index'])->name('order.index');
            Route::get('/new', [App\Http\Controllers\OrderController::class, 'new'])->name('order.new');
        });
    });
});

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
