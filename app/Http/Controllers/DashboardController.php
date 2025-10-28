<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SkKgb;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $tahun = request('tahun', date('Y'));
    
        $bulanList = [];
        $jumlahPegawai = [];
        $jumlahSurat = [];
    
        for ($bulan = 1; $bulan <= 12; $bulan++) {
            $bulanList[] = \Carbon\Carbon::create(null, $bulan)->translatedFormat('F');
        
            $jumlahPegawai[] = \App\Models\SkKgb::whereYear('tmt_gaji_baru', $tahun)
                ->whereMonth('tmt_gaji_baru', $bulan)
                ->count();
        
            $jumlahSurat[] = \App\Models\SkKgb::whereYear('tanggal_surat', $tahun)
                ->whereMonth('tanggal_surat', $bulan)
                ->count();
        }
    
        // jika data kosong (misalnya belum ada KGB tahun itu)
        if (empty($bulanList)) {
            $bulanList = [
                'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
            ];
        }
    
        return view('dashboard.index', compact('bulanList', 'jumlahPegawai', 'jumlahSurat', 'tahun'));
    }
    

    public function showPegawaiByMonth($tahun, $bulan)
    {
        $tahun = (int) $tahun;
        $bulan = (int) $bulan; // 🔥 pastikan integer

        $pegawais = SkKgb::with(['jabatan', 'pejabat', 'golongan'])
            ->whereYear('tmt_gaji_baru', $tahun)
            ->whereMonth('tmt_gaji_baru', $bulan)
            ->orderBy('nama', 'asc')
            ->get();

        // ✅ Versi aman untuk Carbon 3 & PHP 8.4
        $namaBulan = \Carbon\Carbon::createFromDate($tahun, $bulan, 1)->translatedFormat('F');

        return view('dashboard.daftar_pegawai_bulan', compact('pegawais', 'tahun', 'namaBulan'));
    }

}
