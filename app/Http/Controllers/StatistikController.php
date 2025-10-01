<?php

namespace App\Http\Controllers;

use App\Models\SkKgb;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;


class StatistikController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/pegawai-per-bulan/{tahun}",
     *     tags={"Statistik"},
     *     summary="Statistik jumlah SK KGB per bulan dalam tahun tertentu",
     *     description="Mengembalikan jumlah data SK KGB yang dibuat per bulan untuk tahun yang dipilih",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="tahun",
     *         in="path",
     *         required=true,
     *         description="Tahun yang ingin dilihat statistiknya",
     *         @OA\Schema(type="integer", example=2025)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Statistik per bulan berhasil diambil",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="bulan", type="integer", example=1),
     *                 @OA\Property(property="jumlah", type="integer", example=5),
     *                 @OA\Property(property="nama_bulan", type="string", example="Januari")
     *             )
     *         )
     *     ),
     *     @OA\Response(response=401, description="Unauthorized"),
     *     @OA\Response(response=500, description="Server Error")
     * )
     */
    // Statistik SK KGB per bulan dalam satu tahun tertentu
public function statistikPerBulan($tahun)
{
    $data = DB::table('sk_kgb')
        ->selectRaw('MONTH(tanggal_surat) as bulan, COUNT(*) as jumlah')
        ->whereYear('tanggal_surat', $tahun)
        ->groupBy(DB::raw('MONTH(tanggal_surat)'))
        ->orderBy('bulan')
        ->get();

    $bulanIndo = [
        1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
        5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
        9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
    ];

    foreach ($data as $item) {
        $item->nama_bulan = $bulanIndo[$item->bulan];
    }

    return response()->json($data);
}
}