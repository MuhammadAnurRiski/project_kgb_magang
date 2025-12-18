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
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;



class SuratController extends Controller
{
    

    // 🧾 Menampilkan daftar pegawai untuk pilih surat
    public function index(Request $request)
{
    $search = $request->input('search');

    $pegawai = Pegawai::when($search, function ($query) use ($search) {
            $query->where('nama_pegawai', 'like', "%{$search}%")
                  ->orWhere('nip', 'like', "%{$search}%")
                  ->orWhere('jabatan', 'like', "%{$search}%");
        })
        ->paginate(10);

    return view('surat.index', compact('pegawai', 'search'));
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

public function exportDocx($id)
{
    $surat = Surat::findOrFail($id);
    $pegawai = $surat->pegawai;
    $pengaturan = Pengaturan::first();

    $phpWord = new \PhpOffice\PhpWord\PhpWord();

    // Default Font
    $phpWord->setDefaultFontName('Arial');
    $phpWord->setDefaultFontSize(12);

    $phpWord->setDefaultParagraphStyle([
    'spaceBefore' => 0,
    'spaceAfter'  => 0,
    'spacing'     => 120, // default Word 240 → lebih rapat
]);

     $section = $phpWord->addSection([
        'marginTop'    => 400,
        'marginBottom' => 400,
        'marginLeft'   => 900,
        'marginRight'  => 900,
    ]);

    /*
    |--------------------------------------------------------------------------
    | KOP SURAT
    |--------------------------------------------------------------------------
    */
    $table = $section->addTable(['borderSize' => 0, 'cellMargin' => 0]);
    $table->addRow();

    $cell1 = $table->addCell(1500);
    if ($pengaturan->logo_instansi && file_exists(public_path("storage/".$pengaturan->logo_instansi))) {
        $cell1->addImage(public_path("storage/".$pengaturan->logo_instansi), [
            'width' => 70,
            'align' => 'center'
        ]);
    }

    $cell2 = $table->addCell(8000);
    $cell2->addText(
        strtoupper($pengaturan->nama_instansi),
        ['bold' => true, 'size' => 14],
        ['align' => 'center']
    );
    $cell2->addText(
        "KANTOR WILAYAH KALIMANTAN SELATAN",
        ['bold' => true, 'size' => 14],
        ['align' => 'center']
    );
    $cell2->addText(
        $pengaturan->alamat_instansi,
        ['size' => 11],
        ['align' => 'center']
    );

    $section->addText('', [], [
    'borderBottomSize' => 18,
    'borderBottomColor' => '000000',
    'spaceAfter'=>120,
]);

    /*
    |--------------------------------------------------------------------------
    | HEADER SURAT
    |--------------------------------------------------------------------------
    */
    $section->addTextBreak(1);

    $hTable = $section->addTable(['borderSize' => 0]);

    // Row Nomor
    $hTable->addRow();
    $hTable->addCell(1500)->addText("Nomor");
    $hTable->addCell(200)->addText(":");
    $hTable->addCell(3500)->addText($surat->nomor_surat);
    $hTable->addCell(3500)->addText(
        \Carbon\Carbon::parse($surat->tanggal_surat)->translatedFormat("d F Y"),
        null,
        ['align' => 'right']
    );

    // Lampiran
    $hTable->addRow();
    $hTable->addCell()->addText("Lampiran");
    $hTable->addCell()->addText(":");
    $hTable->addCell()->addText("-");
    $hTable->addCell()->addText("");

    // Hal
    $hTable->addRow();
    $hTable->addCell()->addText("Hal");
    $hTable->addCell()->addText(":");
    $hTable->addCell()->addText("Kenaikan Gaji Berkala a.n. ".$pegawai->nama_pegawai);
    $hTable->addCell()->addText("");

    /*
    |--------------------------------------------------------------------------
    | ALAMAT TUJUAN
    |--------------------------------------------------------------------------
    */

    $section->addTextBreak(1);
    $section->addText("Yth. Kepala Kantor Pelayanan Perbendaharaan Negara", [], []);
    $section->addText("di Banjarmasin", [], []);

    /*
    |--------------------------------------------------------------------------
    | PARAGRAF PEMBUKA
    |--------------------------------------------------------------------------
    */

    $section->addTextBreak(1);

    $section->addText(
        "     Dengan ini diberitahukan bahwa telah dipenuhinya masa kerja dan syarat-syarat lainnya kepada:",
        [],
        ['align' => 'both']
    );

    /*
    |--------------------------------------------------------------------------
    | IDENTITAS PEGAWAI
    |--------------------------------------------------------------------------
    */

    $section->addTextBreak(0.5);

    $bio = $section->addTable(['borderSize' => 0]);
    $bio->addRow()->addCell(2500)->addText("1. Nama");
    $bio->addCell()->addText(": ".$pegawai->nama_pegawai);

    $bio->addRow()->addCell()->addText("2. NIP");
    $bio->addCell()->addText(": ".$pegawai->nip);

    $bio->addRow()->addCell()->addText("3. Pangkat / Golongan");
    $bio->addCell()->addText(": ".$pegawai->pangkat_golongan);

    $bio->addRow()->addCell()->addText("4. Unit Kerja");
    $bio->addCell()->addText(": ".$surat->unit_kerja);

    $bio->addRow()->addCell()->addText("5. Gaji Pokok Lama");
    $bio->addCell()->addText(": Rp ".number_format($pegawai->nominal_gaji, 0, ',', '.'));

    /*
    |--------------------------------------------------------------------------
    | DATA SK TERAKHIR
    |--------------------------------------------------------------------------
    */

    $section->addTextBreak(1);
    $section->addText(
        "     Atas dasar surat keputusan terakhir tentang penyesuaian gaji pokok yang ditetapkan:",
        [],
        ['align' => 'both']
    );

    $sk = $section->addTable(['borderSize' => 0]);
    $sk->addRow()->addCell(2500)->addText("a. Oleh");
    $sk->addCell()->addText(": ".$surat->Oleh);

    $sk->addRow()->addCell()->addText("b. Nomor");
    $sk->addCell()->addText(": ".$pegawai->no_sk);

    $sk->addRow()->addCell()->addText("c. Tanggal");
    $sk->addCell()->addText(": ".\Carbon\Carbon::parse($pegawai->tanggal)->translatedFormat("d F Y"));

    $sk->addRow()->addCell()->addText("d. Tanggal mulai");
    $sk->addCell()->addText(": ".\Carbon\Carbon::parse($pegawai->tmt_kgb)->translatedFormat("d F Y"));

    $sk->addRow()->addCell()->addText("e. Masa Kerja Golongan");
    $sk->addCell()->addText(": ".$pegawai->masa_kerja_tahun." Tahun ".$pegawai->masa_kerja_bulan." Bulan");

    /*
    |--------------------------------------------------------------------------
    | DATA KGB BARU
    |--------------------------------------------------------------------------
    */

    $section->addTextBreak(1);
    $section->addText("     Diberikan Kenaikan Gaji Berkala, hingga memperoleh:");

    $kgb = $section->addTable(['borderSize' => 0]);
    $kgb->addRow()->addCell(2500)->addText("6. Gaji Pokok Baru");
    $kgb->addCell()->addText(": Rp ".number_format($pegawai->nominal_gaji_baru, 0, ',', '.'));

    $kgb->addRow()->addCell()->addText("7. Berdasarkan Masa Kerja");
    $kgb->addCell()->addText(": ".$pegawai->mkg_tahun_selanjutnya." Tahun ".$pegawai->mkg_bulan_selanjutnya." Bulan");

    $kgb->addRow()->addCell()->addText("8. Dalam Golongan");
    $kgb->addCell()->addText(": ".$surat->nama_golongan);

    $kgb->addRow()->addCell()->addText("9. Mulai Tanggal");
    $kgb->addCell()->addText(": ".\Carbon\Carbon::parse($pegawai->tmt_pangkat_01)->translatedFormat("d F Y"));

    $kgb->addRow()->addCell()->addText("10. Kenaikan gaji berkala");
    $kgb->addCell()->addText(": ".\Carbon\Carbon::parse($pegawai->kgb_selanjutnya)->translatedFormat("d F Y"));

    /*
    |--------------------------------------------------------------------------
    | PENUTUP
    |--------------------------------------------------------------------------
    */

    $section->addTextBreak(1);
    $section->addText(
        "     Diharap agar sesuai dengan Peraturan Pemerintah Nomor 5 Tahun 2024 kepada Pegawai tersebut dapat dibayarkan penghasilannya berdasarkan gaji pokok tersebut.",
        [],
        ['align' => 'both']
    );

    // Tanda tangan
    $section->addTextBreak(2);
    $section->addText($pegawai->jabatan_pejabat_penetap, [], ['align' => 'right']);

    if ($pengaturan->tanda_tangan && file_exists(public_path("storage/".$pengaturan->tanda_tangan))) {
        $section->addImage(public_path("storage/".$pengaturan->tanda_tangan), [
            'width' => 90,
            'align' => 'right'
        ]);
    }

    $section->addText($pegawai->pejabat_penetap, ['bold' => true], ['align' => 'right']);

    /*
    |--------------------------------------------------------------------------
    | TEMBUSAN
    |--------------------------------------------------------------------------
    */

    $section->addTextBreak(2);
    $section->addText("Tembusan:");
    $section->addText("1. Pembuat Daftar Gaji yang bersangkutan");
    $section->addText("2. Pegawai Negeri Sipil yang bersangkutan");

    /*
    |--------------------------------------------------------------------------
    | GENERATE FILE
    |--------------------------------------------------------------------------
    */

    $fileName = "Surat_KGB_".$surat->id.".docx";
    $path = storage_path($fileName);

    $writer = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
    $writer->save($path);

    return response()->download($path)->deleteFileAfterSend(true);
}
    }



    