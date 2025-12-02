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

    $section = $phpWord->addSection([
        'marginTop'    => 500,
        'marginBottom' => 500,
        'marginLeft'   => 700,
        'marginRight'  => 600,
    ]);

    /*
    |--------------------------------------------------------------------------
    | KOP SURAT
    |--------------------------------------------------------------------------
    */

    $tableStyle = [
        'cellMarginLeft' => 0,
        'alignment'      => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER
    ];

    $table = $section->addTable($tableStyle);
    $table->addRow();

    // Logo kiri
    $cellLogo = $table->addCell(1200);
    if ($pengaturan->logo_instansi && file_exists(public_path('storage/'.$pengaturan->logo_instansi))) {
        $cellLogo->addImage(
            public_path('storage/'.$pengaturan->logo_instansi),
            ['width' => 70]
        );
    }

    // Kop tengah
    $cellText = $table->addCell(8000);
    $cellText->addText(strtoupper($pengaturan->nama_instansi), ['bold' => true, 'size' => 14], ['align' => 'center']);
    $cellText->addText("KANTOR WILAYAH KALIMANTAN SELATAN", ['bold' => true, 'size' => 14], ['align' => 'center']);
    $cellText->addText($pengaturan->alamat_instansi, ['size' => 12], ['align' => 'center']);

    // Garis bawah
    $section->addLine(['weight' => 1, 'width' => 500, 'color' => '#000']);

    /*
    |--------------------------------------------------------------------------
    | HEADER SURAT
    |--------------------------------------------------------------------------
    */

    $section->addTextBreak(1);

    $header = $section->addTable();
    $header->addRow();
    $header->addCell(2000)->addText("Nomor");
    $header->addCell(200)->addText(":");
    $header->addCell(4000)->addText($surat->nomor_surat ?? "................");
    $header->addCell(3000)->addText(
        \Carbon\Carbon::parse($surat->tanggal_surat ?? now())->translatedFormat("d F Y"),
        null,
        ['align' => 'right']
    );

    $header->addRow();
    $header->addCell()->addText("Lampiran");
    $header->addCell()->addText(":");
    $header->addCell()->addText("-");
    $header->addCell()->addText("");

    $header->addRow();
    $header->addCell()->addText("Hal");
    $header->addCell()->addText(":");
    $header->addCell()->addText("Kenaikan Gaji Berkala a.n. ".$pegawai->nama_pegawai);
    $header->addCell()->addText("");

    /*
    |--------------------------------------------------------------------------
    | TUJUAN
    |--------------------------------------------------------------------------
    */

    $section->addTextBreak(1);
    $section->addText(
        "Yth. Kepala Kantor Pelayanan Perbendaharaan Negara\nDi Banjarmasin",
        null,
        ['spacing' => 120]
    );

    /*
    |--------------------------------------------------------------------------
    | PARAGRAF PEMBUKA
    |--------------------------------------------------------------------------
    */

    $section->addTextBreak(1);

    $section->addText(
        "     Dengan ini diberitahukan bahwa telah dipenuhinya masa kerja dan syarat-syarat lainnya kepada:",
        null,
        ['align' => 'both']
    );

    /*
    |--------------------------------------------------------------------------
    | IDENTITAS PEGAWAI
    |--------------------------------------------------------------------------
    */

    $section->addTextBreak(0.5);

    $bio = $section->addTable();
    $bio->addRow()->addCell()->addText("1. Nama");
    $bio->addCell()->addText(": ".$pegawai->nama_pegawai);

    $bio->addRow()->addCell()->addText("2. NIP");
    $bio->addCell()->addText(": ".$pegawai->nip);

    $bio->addRow()->addCell()->addText("3. Pangkat / Golongan");
    $bio->addCell()->addText(": ".$pegawai->pangkat_golongan);

    $bio->addRow()->addCell()->addText("4. Unit Kerja");
    $bio->addCell()->addText(": ".$surat->unit_kerja);

    $bio->addRow()->addCell()->addText("5. Gaji Pokok Lama");
    $bio->addCell()->addText(": Rp ".number_format($pegawai->nominal_gaji,0,',','.').",-");

    /*
    |--------------------------------------------------------------------------
    | DATA SK TERAKHIR
    |--------------------------------------------------------------------------
    */

    $section->addTextBreak(1);
    $section->addText("     Atas dasar surat keputusan terakhir tentang penyesuaian gaji pokok yang ditetapkan:", null, ['align' => 'both']);
    $section->addTextBreak(0.5);

    $sk = $section->addTable();
    $sk->addRow()->addCell()->addText("a. Oleh");
    $sk->addCell()->addText(": ".$surat->Oleh);
    $sk->addRow()->addCell()->addText("b. Nomor");
    $sk->addCell()->addText(": ".$pegawai->no_sk);
    $sk->addRow()->addCell()->addText("c. Tanggal");
    $sk->addCell()->addText(": ".\Carbon\Carbon::parse($pegawai->tanggal)->translatedFormat("d F Y"));
    $sk->addRow()->addCell()->addText("d. TMT");
    $sk->addCell()->addText(": ".\Carbon\Carbon::parse($pegawai->tmt_kgb)->translatedFormat("d F Y"));
    $sk->addRow()->addCell()->addText("e. Masa Kerja");
    $sk->addCell()->addText(": ".$pegawai->masa_kerja_tahun." Tahun ".$pegawai->masa_kerja_bulan." Bulan");

    /*
    |--------------------------------------------------------------------------
    | DATA KGB BARU
    |--------------------------------------------------------------------------
    */

    $section->addTextBreak(1);
    $section->addText("     Diberikan Kenaikan Gaji Berkala, hingga memperoleh:");
    $section->addTextBreak(0.5);

    $kgb = $section->addTable();
    $kgb->addRow()->addCell()->addText("6. Gaji Pokok Baru");
    $kgb->addCell()->addText(": Rp ".number_format($pegawai->nominal_gaji_baru,0,',','.').",-");

    $kgb->addRow()->addCell()->addText("7. Masa Kerja");
    $kgb->addCell()->addText(": ".$pegawai->mkg_tahun_selanjutnya." Tahun ".$pegawai->mkg_bulan_selanjutnya." Bulan");

    $kgb->addRow()->addCell()->addText("8. Dalam Golongan");
    $kgb->addCell()->addText(": ".$surat->nama_golongan);

    $kgb->addRow()->addCell()->addText("9. Mulai Tanggal");
    $kgb->addCell()->addText(": ".\Carbon\Carbon::parse($pegawai->tmt_pangkat_01)->translatedFormat("d F Y"));

    $kgb->addRow()->addCell()->addText("10. KGB Selanjutnya");
    $kgb->addCell()->addText(": ".\Carbon\Carbon::parse($pegawai->kgb_selanjutnya)->translatedFormat("d F Y"));

    /*
    |--------------------------------------------------------------------------
    | PENUTUP + TANDA TANGAN
    |--------------------------------------------------------------------------
    */

    $section->addTextBreak(1);
    $section->addText(
        "     Diharap agar sesuai dengan Peraturan Pemerintah Nomor 5 Tahun 2024 ...",
        null,
        ['align' => 'both']
    );

    // Tanda tangan kanan
    $section->addTextBreak(2);
    $section->addText($pegawai->jabatan_pejabat_penetap, null, ['align' => 'right']);

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
    $section->addText("Tembusan:", ['bold' => true]);
    $section->addText("1. Pembuat Daftar Gaji");
    $section->addText("2. Pegawai yang bersangkutan");

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



    