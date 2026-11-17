
<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LokasiObservasiController;
use App\Http\Controllers\KegiatanObservasiController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\PerlengkapanController;
use App\Http\Controllers\PublicLokasiObservasiController;
use App\Http\Controllers\PublicKegiatanObservasiController;
use App\Http\Controllers\PublicPerlengkapanController;

// BERANDA PUBLIK
Route::get('/', function () {
    return view('beranda');
})->name('beranda');

// LOGIN ADMIN
Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.process');

// LOKASI OBSERVASI PUBLIK
Route::get('/lokasi-observasi', [PublicLokasiObservasiController::class, 'index'])
    ->name('public.lokasi.index');

Route::get('/lokasi-observasi/{id}', [PublicLokasiObservasiController::class, 'show'])
    ->name('public.lokasi.show');

// KEGIATAN OBSERVASI PUBLIK
Route::get('/kegiatan-observasi', [PublicKegiatanObservasiController::class, 'index'])
    ->name('public.kegiatan.index');

Route::get('/kegiatan-observasi/{id}', [PublicKegiatanObservasiController::class, 'show'])
    ->name('public.kegiatan.show');

// PERLENGKAPAN PUBLIK
Route::get('/perlengkapan-observasi', [PublicPerlengkapanController::class, 'index'])
    ->name('public.perlengkapan.index');

Route::get('/perlengkapan-observasi/{id}', [PublicPerlengkapanController::class, 'show'])
    ->name('public.perlengkapan.show');

// HALAMAN KHUSUS ADMIN
Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::resource('lokasi', LokasiObservasiController::class);

    Route::resource('kegiatan', KegiatanObservasiController::class);

    Route::resource('peserta', PesertaController::class)
        ->parameters(['peserta' => 'peserta']);

    Route::resource('perlengkapan', PerlengkapanController::class);

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');
});
