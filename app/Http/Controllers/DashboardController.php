<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use Carbon\Carbon;


class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Ambil semua tahun unik dari kolom tmt_kgb di tabel profil_pegawai
        $availableYears = Pegawai::selectRaw('YEAR(kgb_selanjutnya) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year')
            ->toArray();

        // Tahun aktif dipilih dari dropdown (default tahun sekarang)
        $selectedYear = $request->get('year'); // hapus default now()->year

        // Hitung jumlah pegawai per bulan berdasarkan tahun yang dipilih
        $pegawaiCounts = Pegawai::selectRaw('MONTH(kgb_selanjutnya) as month, COUNT(*) as count')
            ->whereYear('kgb_selanjutnya', $selectedYear)
            ->groupByRaw('MONTH(kgb_selanjutnya)')
            ->pluck('count', 'month')
            ->toArray();

        $months = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];

        $kgbData = [];
        $totalPegawai = 0;

        foreach ($months as $num => $name) {
            $jumlah = isset($pegawaiCounts[$num]) ? (int) $pegawaiCounts[$num] : 0;
            $totalPegawai += $jumlah;

            $kgbData[] = [
                'bulan' => $name,
                'jumlah_pegawai' => $jumlah,
            ];
        }

        return view('dashboard.index', compact('kgbData', 'totalPegawai', 'availableYears', 'selectedYear'));
    }

    public function detail(Request $request)
{
    $bulan = $request->get('bulan');
    $tahun = $request->get('year');

    // Mapping nama bulan Indonesia ke angka bulan
    $bulanMap = [
        'Januari' => 1,
        'Februari' => 2,
        'Maret' => 3,
        'April' => 4,
        'Mei' => 5,
        'Juni' => 6,
        'Juli' => 7,
        'Agustus' => 8,
        'September' => 9,
        'Oktober' => 10,
        'November' => 11,
        'Desember' => 12,
    ];

    $bulanAngka = $bulanMap[$bulan] ?? null;

    if (!$bulanAngka) {
        abort(400, 'Nama bulan tidak valid.');
    }

    $pegawaiList = \App\Models\Pegawai::whereYear('kgb_selanjutnya', $tahun)
    ->whereMonth('kgb_selanjutnya', $bulanAngka)
    ->get();

    return view('dashboard.detail', compact('bulan', 'tahun', 'pegawaiList'));
}


}
