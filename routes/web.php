<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\DetailTransaksiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\ImageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/upload', [ImageController::class, 'create']);
Route::post('/upload', [ImageController::class, 'store'])->name('image.upload');
Route::delete('/upload/{id}', [ImageController::class, 'destroy'])->name('image.delete');

Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AdminLoginController::class, 'login']);
Route::post('/logout', [AdminLoginController::class, 'logout'])->name('logout');

Route::middleware(['auth:admin'])->group(function () {

    // Transaksi (detail & edit hanya untuk Manager dan Staff)
    Route::get('/transaksi/{id}/edit', [TransaksiController::class, 'edit'])->middleware('cek.admin.transaksi');
    Route::get('/transaksi/{id}', [TransaksiController::class, 'show'])->middleware('cek.admin.transaksi');

    // Transaksi index bisa diakses semua role admin
    Route::resource('transaksi', TransaksiController::class)->only(['index']);

    Route::resource('pelanggan', PelangganController::class);
    Route::get('/pelanggan/{id}/delete', [PelangganController::class, 'delete'])->name('pelanggan.delete');
    Route::resource('admin', AdminController::class);
    Route::get('/admin/{id}/delete', [AdminController::class, 'delete'])->name('admin.delete');
    Route::resource('layanan', LayananController::class);
    Route::resource('detailTransaksi', DetailTransaksiController::class);
});

// Halaman akses ditolak untuk role 'Admin' saat akses detail/edit transaksi
Route::get('/akses-ditolak', function () {
    return view('errors.akses-ditolak');
})->name('akses-ditolak');

Route::get('/', function () {
    return view('welcome');
});
