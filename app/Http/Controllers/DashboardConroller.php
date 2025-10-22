<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SkKgb;

class DashboardController extends Controller
{
    public function index()
    {
        $tahun = request('tahun', date('Y'));

        // Ambil data pegawai KGB berdasarkan bulan
        $dataPerBulan = [];
        for ($bulan = 1; $bulan <= 12; $bulan++) {
            $pegawaiKgb = SkKgb::whereYear('tmt_gaji_baru', $tahun)
                ->whereMonth('tmt_gaji_baru', $bulan)
                ->count();

            $suratTercetak = SkKgb::whereYear('tanggal_surat', $tahun)
                ->whereMonth('tanggal_surat', $bulan)
                ->count();

            $dataPerBulan[] = [
                'bulan' => $bulan,
                'nama_bulan' => \Carbon\Carbon::create()->month($bulan)->translatedFormat('F'),
                'pegawai' => $pegawaiKgb,
                'surat' => $suratTercetak,
            ];
        }

        return view('dashboard.index', compact('dataPerBulan', 'tahun'));
    }

    // ✅ AJAX: ambil data pegawai per bulan (untuk modal)
    public function showPegawaiByMonth($tahun, $bulan)
    {
        // Ambil semua pegawai yang mengalami KGB di bulan dan tahun ini
        $pegawais = \App\Models\SkKgb::with(['jabatan', 'pejabat', 'golongan'])
            ->whereYear('tmt_gaji_baru', $tahun)
            ->whereMonth('tmt_gaji_baru', $bulan)
            ->orderBy('nama', 'asc')
            ->get();
    
        // Nama bulan untuk ditampilkan di judul
        $namaBulan = \Carbon\Carbon::create()->month($bulan)->translatedFormat('F');
    
        return view('dashboard.daftar_pegawai_bulan', compact('pegawais', 'tahun', 'namaBulan'));
    }
    
    
}
