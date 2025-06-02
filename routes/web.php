<?php

use App\Http\Controllers\OrderHistoryController;
use App\Http\Controllers\UserManageController;
use App\Http\Controllers\TicketManageController;
use App\Http\Controllers\AdminTicketController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PenerbanganController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

// routes/web.php
Route::get('/', function () {
    return view('home');
})->name('home');



Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/tiket/tambah', [AdminTicketController::class, 'create'])->name('admin.tiket.create');
    Route::post('/admin/tiket/tambah', [AdminTicketController::class, 'store'])->name('admin.tiket.store');
        Route::get('/admin/tiket', [TicketManageController::class, 'index'])
         ->name('tickets.index');

    // Jika butuh edit dan update:
    Route::get('/admin/tiket/{id}/edit', [TicketManageController::class, 'edit'])
         ->name('tickets.edit');
    Route::put('/admin/tiket/{id}', [TicketManageController::class, 'update'])
         ->name('tickets.update');

    // Jika butuh delete:
    Route::delete('/admin/tiket/{id}', [TicketManageController::class, 'destroy'])
         ->name('tickets.destroy');
    Route::get('/admin/pengguna', [UserManageController::class, 'index'])
         ->name('user.index');
    Route::get('/admin/riwayat-pesanan', [OrderHistoryController::class, 'index'])
         ->name('orders.index');
});




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/cari-tiket', [PenerbanganController::class, 'index'])->name('cari.tiket');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/riwayat_eticket', [RiwayatController::class, 'index'])->name('riwayat.eticket');
});

Route::get('/booking', [BookingController::class, 'create'])->middleware('auth')->name('booking.create');
Route::post('/booking', [BookingController::class, 'store'])->middleware('auth')->name('booking.store');
Route::get('/pembayaran', [PaymentController::class, 'show'])->middleware('auth')->name('pembayaran');
Route::post('/pembayaran/konfirmasi', [PaymentController::class, 'confirm'])->middleware('auth')->name('pembayaran.confirm');

require __DIR__ . '/auth.php';




