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

public function downloadDocx($id)
{
    $surat = Surat::with('pegawai')->findOrFail($id);
    $pegawai = $surat->pegawai;
    $pengaturan = Pengaturan::first();

    $phpWord = new \PhpOffice\PhpWord\PhpWord();
    $phpWord->setDefaultFontName('Arial');
    $phpWord->setDefaultFontSize(12);

    // Konfigurasi margin
    $section = $phpWord->addSection([
        'marginLeft'   => 800,  // 1.3 cm
        'marginRight'  => 800,
        'marginTop'    => 800,
        'marginBottom' => 800,
    ]);

    /* ============================
       1. KOP SURAT
    ============================= */
    $table = $section->addTable();

    $table->addRow();
    $cell1 = $table->addCell(1500);
    $cell2 = $table->addCell(8000);

    // Logo
    if ($pengaturan->logo_instansi && file_exists(public_path('storage/'.$pengaturan->logo_instansi))) {
        $cell1->addImage(
            public_path('storage/' . $pengaturan->logo_instansi),
            ['width' => 80, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::LEFT]
        );
    }

    // Teks kop
    $cell2->addText(strtoupper($pengaturan->nama_instansi), ['bold' => true, 'size' => 14], ['alignment' => 'center']);
    $cell2->addText("KANTOR WILAYAH KALIMANTAN SELATAN", ['bold' => true, 'size' => 13], ['alignment' => 'center']);
    $cell2->addText($pengaturan->alamat_instansi, ['size' => 11], ['alignment' => 'center']);

    $section->addLine(['weight' => 1, 'width' => 9000, 'height' => 0]);

    /* ============================
       2. HEADER SURAT
    ============================= */
    $section->addTextBreak(1);

    $headerTable = $section->addTable();
    $headerTable->addRow();
    $headerTable->addCell(1500)->addText('Nomor');
    $headerTable->addCell(200)->addText(':');
    $headerTable->addCell(5000)->addText($surat->nomor_surat ?? '..................');
    $headerTable->addCell(3000)->addText(
        \Carbon\Carbon::parse($surat->tanggal_surat)->translatedFormat('d F Y'),
        [],
        ['alignment' => 'right']
    );

    $headerTable->addRow();
    $headerTable->addCell()->addText('Lampiran');
    $headerTable->addCell()->addText(':');
    $headerTable->addCell()->addText('-');
    $headerTable->addCell()->addText('');

    $headerTable->addRow();
    $headerTable->addCell()->addText('Hal');
    $headerTable->addCell()->addText(':');
    $headerTable->addCell()->addText("Kenaikan Gaji Berkala a.n. {$pegawai->nama_pegawai}");
    $headerTable->addCell()->addText('');

    /* ============================
       3. PARAGRAF PEMBUKA
    ============================= */
    $section->addTextBreak();
    $section->addText(
        "Yth. Kepala Kantor Pelayanan Perbendaharaan Negara di Banjarmasin",
        [],
        ['alignment' => 'left']
    );

    $section->addTextBreak(1);

    $section->addText(
        "    Dengan ini diberitahukan bahwa telah dipenuhinya masa kerja dan syarat-syarat lainnya kepada:",
        [],
        ['alignment' => 'both']
    );

    /* ============================
       4. TABEL IDENTITAS PEGAWAI
    ============================= */
    $identitas = $section->addTable();

    $identitas->addRow();
    $identitas->addCell(500)->addText("1.");
    $identitas->addCell(2500)->addText("Nama");
    $identitas->addCell(300)->addText(":");
    $identitas->addCell(6000)->addText($pegawai->nama_pegawai);

    $identitas->addRow();
    $identitas->addCell()->addText("2.");
    $identitas->addCell()->addText("NIP");
    $identitas->addCell()->addText(":");
    $identitas->addCell()->addText($pegawai->nip);

    $identitas->addRow();
    $identitas->addCell()->addText("3.");
    $identitas->addCell()->addText("Pangkat / Golongan");
    $identitas->addCell()->addText(":");
    $identitas->addCell()->addText($pegawai->pangkat_golongan);

    /* dst… saya bisa lengkapi semua kolom sesuai preview kamu */

    /* ============================
       5. TTD
    ============================= */
    $section->addTextBreak(2);

    $section->addText($pegawai->jabatan_pejabat_penetap, [], ['alignment' => 'right']);

    if ($pengaturan->tanda_tangan && file_exists(public_path('storage/'.$pengaturan->tanda_tangan))) {
        $section->addImage(
            public_path('storage/' . $pengaturan->tanda_tangan),
            ['width' => 90, 'alignment' => 'right']
        );
    }

    $section->addText($pegawai->pejabat_penetap, ['bold' => true], ['alignment' => 'right']);

    /* ============================
       6. TEMBUSAN
    ============================= */
    $section->addTextBreak(3);
    $section->addText("Tembusan:");
    $section->addText("1. Pembuat Daftar Gaji yang bersangkutan");
    $section->addText("2. Pegawai Negeri Sipil yang bersangkutan");

    /* ============================
       EXPORT FILE
    ============================= */
    $filename = "Surat_KGB_{$pegawai->nama_pegawai}.docx";
    $writer = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');

    return response()->streamDownload(function () use ($writer) {
        $writer->save("php://output");
    }, $filename);
}

    }



    