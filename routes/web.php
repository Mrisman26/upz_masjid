<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KalkulatorZakatController;
use App\Http\Controllers\KepalaKeluargaController;
use App\Http\Controllers\MustahikController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RekapZakatController;
use App\Http\Controllers\RtRwController;
use App\Http\Controllers\ZakatController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Nonaktifkan sementara auth middleware untuk debugging
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {

    Route::resource('zakat', ZakatController::class);
    Route::resource('rt-rw', RtRwController::class);
    Route::resource('kepala-keluarga', KepalaKeluargaController::class);
    Route::resource('mustahik', MustahikController::class);

    Route::get('rekap-zakat', [RekapZakatController::class, 'zakat'])->name('rekap-zakat');
    Route::get('rekap-mustahik', [RekapZakatController::class, 'mustahik'])->name('rekap-mustahik');

    Route::get('/rekap-kalkulator', [KalkulatorZakatController::class, 'index'])->name('rekap-kalkulator');

    Route::get('muzaki-cetak/{tahun?}', [PdfController::class, 'muzakiPDF'])->name('muzaki-cetak');
    Route::get('mustahik-cetak', [PdfController::class, 'mustahikPDF'])->name('mustahik-cetak');
    Route::get('/rekap-zakat/cetak/{tahun?}', [PdfController::class, 'zakatPDF'])->name('rekap-zakat.cetak');

});

require __DIR__.'/auth.php';
