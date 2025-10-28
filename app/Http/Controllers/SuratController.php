<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SkKgb;

class SuratController extends Controller
{
    /**
     * 📨 Tampilkan halaman daftar surat atau modal cetak
     */
    public function index()
    {
        $pegawais = SkKgb::with('jabatan')->orderBy('nama', 'asc')->get();
        return view('surat.index', compact('pegawais'));
    }

    /**
     * 🖨️ Menampilkan modal cetak surat
     */
    public function loadModal($id)
    {
        // 🔹 Ambil data lengkap pegawai berdasarkan id_sk
        $pegawai = \App\Models\SkKgb::with([
            'jabatan',
            'golongan',
            'pejabat'
        ])->where('id_sk', $id)->first();
        
        // 🔹 Jika data tidak ditemukan, tampilkan error
        if (!$pegawai) {
            return response("<p class='text-danger text-center'>Data pegawai tidak ditemukan.</p>");
        }
    
        // 🔹 Kirim data ke view modal-content (bukan modal lama)
        return view('surat.modal-content', compact('pegawai'));
    }
    

    /**
     * 👁️ Preview surat sebelum cetak
     */
    public function preview($id)
    {
        $pegawai = SkKgb::with(['jabatan','golongan','pejabat'])->findOrFail($id);
        return view('surat.preview', compact('pegawai'));
    }


    /**
     * 🧾 Export surat dalam bentuk PDF
     */
    public function exportPdf($id)
    {
        $pegawai = SkKgb::with(['jabatan', 'golongan', 'pejabat'])->findOrFail($id);

        $pdf = \PDF::loadView('surat.pdf', compact('pegawai'))
            ->setPaper('A4', 'portrait');

        return $pdf->stream('Surat_KGB_' . $pegawai->nama . '.pdf');
    }
}
