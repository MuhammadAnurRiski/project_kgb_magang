<?php
namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Surat;
use App\Models\Pengaturan;
use App\Models\golongan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Dokuman;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class SuratController extends Controller
{
    

    // 🧾 Menampilkan daftar pegawai untuk pilih surat
    public function index()
    {
        $pegawai = Pegawai::paginate(10);
        return view('surat.index', compact('pegawai'));
    }

    

    public function edit($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        $surat = Surat::firstOrCreate(['id_pegawai' => $id]);
        $pengaturan = Pengaturan::first();
        $golongan = Golongan::pluck('nama_golongan'); // ambil nama golongan saja

        return view('surat.edit', compact('pegawai', 'surat', 'pengaturan', 'golongan'));
    }

    public function preview($id)
{
    $pegawai = Pegawai::findOrFail($id);
    $surat = Surat::where('id_pegawai', $id)->first();
    $pengaturan = Pengaturan::first();
   $golongan = Golongan::pluck('nama_golongan');

    // Pastikan view surat.preview sudah ada di resources/views/surat/preview.blade.php
    return view('surat.preview', compact('pegawai', 'surat', 'pengaturan', 'golongan'));
}


    public function update(Request $request, $id)
    {
        $request->validate([
            'no_surat' => 'nullable|string|max:255',
            'unit_kerja'=> 'nullable|string|max:255',
            'tanggal_surat' => 'nullable|date',
            'Oleh'=> 'nullable|string|max:255',
            'golongan' => 'nullable|string|max:255',
        ]);

        $surat = Surat::findOrFail($id);
        $surat->update($request->all());

        return response()->json(['success' => true]);
    }

  public function cetak($id)
{
    // Ambil surat berdasarkan id surat
    $surat = Surat::with('pegawai')->findOrFail($id);
    // Ambil data pegawai dari relasi
    $pegawai = $surat->pegawai;
    // Ambil pengaturan
    $pengaturan = Pengaturan::first();
    $golongan = Golongan::pluck('nama_golongan'); // ambil nama golongan saja

    // Pastikan data pegawai tidak null
    if (!$pegawai) {
        abort(404, 'Data pegawai tidak ditemukan untuk surat ini.');
    }

    // Buat PDF
    $pdf = PDF::loadView('surat.preview', compact('pegawai', 'surat', 'pengaturan'))
          ->setPaper('A4', 'portrait')
          ->setOptions([
              'defaultFont' => 'Arial',
              'isHtml5ParserEnabled' => true,
              'isRemoteEnabled' => true,
              'margin-top' => 20,
        'margin-right' => 20,
        'margin-bottom' => 20,
        'margin-left' => 20,
          ]);
return $pdf->stream("Surat_KGB_{$pegawai->nama_pegawai}.pdf");
}

    }



    