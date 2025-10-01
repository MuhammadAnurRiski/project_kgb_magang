<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SkKgbController;
use Illuminate\Http\Request;
use App\Http\Controllers\StatistikController;
use App\Http\Controllers\AuthController;

Route::middleware('auth:sanctum')->group(function () {
    
    // Route Statistik
Route::get('/pegawai-per-bulan/{tahun}', [StatistikController::class, 'statistikPerBulan']);

// Route SK KGB
Route::post('/skkgb/create', [SkKgbController::class, 'create']);
Route::get('/skkgb', [SkKgbController::class, 'index']);
Route::get('/skkgb/{id}', [SkKgbController::class, 'show']);
Route::put('/skkgb/{id}', [SkKgbController::class, 'update']);
Route::delete('/skkgb/{id}', [SkKgbController::class, 'destroy']);

// route tambahan untuk mencari sk kgb by nama atau NIP
Route::get('/skkgb/search', [SkKgbController::class, 'search']);


//route logout tambahan
Route::post('/logout', [AuthController::class, 'logout']);
});

// Route Auth (tidak perlu login dulu   untuk mengakses route ini)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

