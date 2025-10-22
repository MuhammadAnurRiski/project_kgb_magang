<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\DashboardController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/logout', function () {
    return redirect('/')->with('success', 'Logout berhasil!');
})->name('logout');

Route::get('/pegawai', [PegawaiController::class, 'index'])->name('pegawai.index');

Route::resource('pegawai', PegawaiController::class);

Route::get('/surat', [SuratController::class, 'index'])->name('surat.index');



Route::get('/pengaturan', [PengaturanController::class, 'index'])->name('pengaturan.index');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/dashboard/pegawai/{tahun}/{bulan}', [DashboardController::class, 'getPegawaiByMonth']);

Route::get('/dashboard/pegawai/{tahun}/{bulan}', [App\Http\Controllers\DashboardController::class, 'showPegawaiByMonth'])
    ->name('dashboard.pegawai.bulan');

Route::

