<?php

namespace App\Http\Controllers;

use App\Models\SkKgb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;


class SkKgbController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/skkgb/create",
     *     tags={"SK KGB"},
     *     summary="Tambah data SK KGB",
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nama","NIP","nomor_surat","tanggal_surat","id_gol_pangkat","id_jabatan","id_unit_kerja","gaji_pokok_lama","tmt_gaji_baru","masa_kerja_baru_thn","masa_kerja_baru_bln","gaji_pokok_baru","tmt_kgb_berikutnya","id_pejabat"},
     *             @OA\Property(property="nama", type="string", example="Budi Santoso"),
     *             @OA\Property(property="NIP", type="integer", example=1234567890),
     *             @OA\Property(property="nomor_surat", type="string", example="SK-001/2025"),
     *             @OA\Property(property="tanggal_surat", type="string", format="date", example="2025-10-02"),
     *             @OA\Property(property="id_gol_pangkat", type="integer", example=2),
     *             @OA\Property(property="id_jabatan", type="integer", example=3),
     *             @OA\Property(property="id_unit_kerja", type="integer", example=1),
     *             @OA\Property(property="gaji_pokok_lama", type="integer", example=5000000),
     *             @OA\Property(property="tmt_gaji_baru", type="string", format="date", example="2025-11-01"),
     *             @OA\Property(property="masa_kerja_baru_thn", type="integer", example=5),
     *             @OA\Property(property="masa_kerja_baru_bln", type="integer", example=6),
     *             @OA\Property(property="gaji_pokok_baru", type="integer", example=5500000),
     *             @OA\Property(property="tmt_kgb_berikutnya", type="string", format="date", example="2027-11-01"),
     *             @OA\Property(property="id_pejabat", type="integer", example=7)
     *         )
     *     ),
     *     @OA\Response(response=201, description="Data SK KGB berhasil ditambahkan"),
     *     @OA\Response(response=401, description="Unauthorized")
     * )
     */
  public function create(Request $request)
  {
    $validated = $request->validate([
      'nama' => 'required|string',
      'NIP' => 'required|integer',
      'nomor_surat' => 'required|string',
      'tanggal_surat' => 'required|date',
      'id_gol_pangkat' => 'required|integer',
      'id_jabatan' => 'required|integer',
      'id_unit_kerja' => 'required|integer',
      'gaji_pokok_lama' => 'required|integer',
      'tmt_gaji_baru' => 'required|date',
      'masa_kerja_baru_thn' => 'required|integer',
      'masa_kerja_baru_bln' => 'required|integer',
      'gaji_pokok_baru' => 'required|integer',
      'tmt_kgb_berikutnya' => 'required|date',
      'id_pejabat' => 'required|integer',
    ]);

    $skkgb = SkKgb::create($validated);

    return response()->json([
      'message' => 'Data SK KGB berhasil ditambahkan',
      'data' => $skkgb
    ], 201);
  } 

  /**
     * @OA\Get(
     *     path="/api/skkgb",
     *     tags={"SK KGB"},
     *     summary="Ambil semua data SK KGB",
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(response=200, description="Data SK KGB berhasil diambil")
     * )
     */

  // melihat data sk kgb
  public function index()
    {
        $skkgb = SkKgb::all();
        return response()->json([
        'message' => 'Data SK KGB berhasil diambil',
        'data' => $skkgb
        ], 200);
    }

  /**
     * @OA\Get(
     *     path="/api/skkgb/{id}",
     *     tags={"SK KGB"},
     *     summary="Ambil detail SK KGB berdasarkan ID",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID SK KGB",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(response=200, description="Data SK KGB berhasil diambil"),
     *     @OA\Response(response=404, description="Data tidak ditemukan")
     * )
     */

    //melihat data sk kgb by id
    public function show($id)   
    {
        $skkgb = SkKgb::find($id);
        if (!$skkgb) {
            return response()->json([
                'message' => 'Data SK KGB tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'message' => 'Data SK KGB berhasil diambil',
            'data' => $skkgb
        ], 200);
    }

    /**
     * @OA\Put(
     *     path="/api/skkgb/{id}",
     *     tags={"SK KGB"},
     *     summary="Update data SK KGB",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID SK KGB",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\RequestBody(
     *         required=false,
     *         @OA\JsonContent(
     *             @OA\Property(property="nama", type="string", example="Budi Update"),
     *             @OA\Property(property="NIP", type="integer", example=1234567890),
     *             @OA\Property(property="nomor_surat", type="string", example="SK-002/2025")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Data SK KGB berhasil diupdate"),
     *     @OA\Response(response=404, description="Data tidak ditemukan")
     * )
     */

    // update data sk kgb
    public function update(Request $request, $id)
    {
        $skkgb = SkKgb::find($id);
        if (!$skkgb) {
            return response()->json([
                'message' => 'Data SK KGB tidak ditemukan'
            ], 404);
        }

        $validated = $request->validate([
            'nama' => 'sometimes|required|string',
            'NIP' => 'sometimes|required|integer',
            'nomor_surat' => 'sometimes|required|string',
            'tanggal_surat' => 'sometimes|required|date',
            'id_gol_pangkat' => 'sometimes|required|integer',
            'id_jabatan' => 'sometimes|required|integer',
            'id_unit_kerja' => 'sometimes|required|integer',
            'gaji_pokok_lama' => 'sometimes|required|integer',
            'tmt_gaji_baru' => 'sometimes|required|date',
            'masa_kerja_baru_thn' => 'sometimes|required|integer',
            'masa_kerja_baru_bln' => 'sometimes|required|integer',
            'gaji_pokok_baru' => 'sometimes|required|integer',
            'tmt_kgb_berikutnya' => 'sometimes|required|date',
            'id_pejabat' => 'sometimes|required|integer',
        ]);

        $skkgb->update($validated);

        return response()->json([
            'message' => 'Data SK KGB berhasil diupdate',
            'data' => $skkgb
        ], 200);
    }

     /**
     * @OA\Delete(
     *     path="/api/skkgb/{id}",
     *     tags={"SK KGB"},
     *     summary="Hapus data SK KGB",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID SK KGB",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(response=200, description="Data SK KGB berhasil dihapus"),
     *     @OA\Response(response=404, description="Data tidak ditemukan")
     * )
     */

    //delete data sk kgb
    public function delete($id)
    {
        $skkgb = SkKgb::find($id);
        if (!$skkgb) {
            return response()->json([
                'message' => 'Data SK KGB tidak ditemukan'
            ], 404);
        }

        $skkgb->delete();

        return response()->json([
            'message' => 'Data SK KGB berhasil dihapus'
        ], 200);
    }
}




