<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RekeningController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\KodePengajuanController;
use App\Http\Controllers\PengajuanController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Redirect Root ke Login
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return redirect()->route('login');
});


/*
|--------------------------------------------------------------------------
| Route yang butuh login
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return inertia('Dashboard');
    })->name('dashboard');


    // Profile
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });


    // Master Data
    Route::resource('rekening', RekeningController::class);
    Route::resource('user', UserController::class);

    // kode pengajuan
    Route::resource('kode-pengajuan', KodePengajuanController::class)->middleware('auth');

    // Pengajuan
    Route::resource('pengajuan', PengajuanController::class)->middleware('auth');

    // Laporan
    Route::prefix('laporan')->group(function () {
        Route::get('/', [LaporanController::class, 'index'])->name('laporan.index');
        Route::get('/rekening/pdf', [LaporanController::class, 'rekeningPdf'])->name('laporan.rekening.pdf');
        Route::get('/rekening/download', [LaporanController::class, 'rekeningDownload'])->name('laporan.rekening.download');
    });

});


/*
|--------------------------------------------------------------------------
| Auth Route (login, register, dll)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';