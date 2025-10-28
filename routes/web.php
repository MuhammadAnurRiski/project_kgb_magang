<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\DokumenController;




/*
|--------------------------------------------------------------------------
| ROUTING SISTEM KGB
|--------------------------------------------------------------------------
*/

// 🟢 Ketika pertama kali buka (/) -> langsung ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// 🟢 Halaman login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// 🟢 Proses login sederhana
Route::post('/login', function (Request $request) {
    $username = $request->input('username');
    $password = $request->input('password');

    if ($username === 'admin' && $password === 'admin1234') {
        session(['user' => $username]);
        return redirect()->route('dashboard');
    }

    return back()->withErrors(['login' => 'Username atau password salah']);
})->name('login.process');

// 🟢 Logout
Route::get('/logout', function () {
    session()->forget('user');
    return redirect()->route('login')->with('success', 'Logout berhasil!');
})->name('logout');


// ===========================================================
// 🟣 ROUTE YANG HANYA BISA DIAKSES SETELAH LOGIN
// ===========================================================
Route::group([], function () {

    // DASHBOARD
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // PEGAWAI
    // PEGAWAI (resource route lengkap)
    Route::resource('pegawai', PegawaiController::class);


    // SURAT
    Route::get('/surat', function () {
        if (!session()->has('user')) {
            return redirect()->route('login');
        }
        return app(SuratController::class)->index();
    })->name('surat.index');

    Route::get('/surat/modal/{id}', [SuratController::class, 'loadModal'])->name('surat.modal');
    Route::get('/surat/preview/{id}', [SuratController::class, 'preview'])->name('surat.preview');
    Route::get('/surat/pdf/{id}', [SuratController::class, 'exportPdf'])->name('surat.pdf');

    
    Route::get('/dokumen', [DokumenController::class, 'index'])->name('dokumen.index');
    

    // PENGATURAN
    Route::get('/pengaturan', function () {
        if (!session()->has('user')) {
            return redirect()->route('login');
        }
        return app(PengaturanController::class)->index();
    })->name('pengaturan.index');

    // DETAIL PEGAWAI DI DASHBOARD (per bulan)
    Route::get('/dashboard/pegawai/{tahun}/{bulan}', function ($tahun, $bulan) {
        if (!session()->has('user')) {
            return redirect()->route('login');
        }
        return app(DashboardController::class)->showPegawaiByMonth($tahun, $bulan);
    })->name('dashboard.pegawai.bulan');

    Route::get('/surat/preview/{id}', [SuratController::class, 'preview'])->name('surat.preview');

});

