<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DokumenController;
use App\Http\Controllers\PengaturanController;




Route::get('/', function () {
    return redirect()->route('login');
});

// Login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');



Route::middleware(['admin.auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/detail', [DashboardController::class, 'detail'])->name('dashboard.detail');

    // Route Pegawai
    Route::resource('pegawai', PegawaiController::class,);
    Route::get('/pegawai', [PegawaiController::class, 'index'])->name('pegawai.index');
    Route::get('/pegawai/{id}/editkgb', [PegawaiController::class, 'editKGB'])->name('pegawai.editkgb');
    Route::put('/pegawai/{id}/updatekgb', [PegawaiController::class, 'updateKGB'])->name('pegawai.updatekgb');
    Route::get('/pegawai/{id}/delete', [PegawaiController::class, 'destroy'])->name('pegawai.delete');
   
    //surat
    Route::get('/surat', [SuratController::class, 'index'])->name('surat.index');
    Route::get('/surat/{id}/edit', [SuratController::class, 'edit'])->name('surat.edit');
    Route::put('/surat/{id}', [SuratController::class, 'update'])->name('surat.update');
    Route::get('/surat/{id}/cetak', [SuratController::class, 'cetak'])->name('surat.cetak');
    Route::get('/surat/{id}/preview', [SuratController::class, 'preview'])->name('surat.preview');

    


    //dokumen
 Route::prefix('dokumen')->name('dokumen.')->group(function () {
    Route::get('/', [DokumenController::class, 'index'])->name('index');
    Route::post('/create-folder', [DokumenController::class, 'createFolder'])->name('createFolder');
    Route::get('/{folderName}', [DokumenController::class, 'showFolder'])->name('showFolder');
    Route::post('/upload', [DokumenController::class, 'uploadFile'])->name('uploadFile');
    Route::get('/file/{id}', [DokumenController::class, 'viewFile'])->name('viewFile');
    Route::delete('/file/{id}', [DokumenController::class, 'deleteFile'])->name('deleteFile');
});

    //pengaturan
    Route::resource('pengaturan', PengaturanController::class,);
    Route::get('/pengaturan', [PengaturanController::class, 'index'])->name('pengaturan.index');
    Route::post('/pengaturan', [PengaturanController::class, 'update'])->name('pengaturan.update');

});

 
