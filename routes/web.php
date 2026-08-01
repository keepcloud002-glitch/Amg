<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('home-toko');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Grup khusus user yang sudah Login (Middleware Auth)
Route::middleware('auth')->group(function () {
    
    // Rute Profile Bawaan Laravel Breeze
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Route untuk UserController
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::put('/users/{id}/role', [UserController::class, 'updateRole'])->name('users.updateRole');
  
    // Rute Tabel & Fitur Barang (Kita masukkan ke sini agar aman & terlindungi)
    Route::get('/barang', [BarangController::class, 'index'])->name('barang');
    Route::get('/barang/tambah', [BarangController::class, 'create'])->name('barang.tambah');
    Route::post('/barang/simpan', [BarangController::class, 'store'])->name('barang.simpan');
    Route::post('/barang/store', [BarangController::class, 'store'])->name('barang.store');
    Route::delete('/barang/hapus/{id}', [BarangController::class, 'destroy'])->name('barang.hapus');
    // Rute untuk menampilkan form edit berdasarkan ID barang
    Route::get('/barang/edit/{id}', [BarangController::class, 'edit'])->name('barang.edit');
    // Rute untuk memproses penyimpanan perubahan data ke database
    Route::put('/barang/update/{id}', [BarangController::class, 'update'])->name('barang.update');


}); // <--- PENUTUP GRUP MIDDLEWARE YANG TADI KURANG ADA DI SINI

require __DIR__.'/auth.php';
