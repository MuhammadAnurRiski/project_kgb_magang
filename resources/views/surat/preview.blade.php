<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Kenaikan Gaji Berkala</title>
    <style>
        body { font-family: "Times New Roman", serif; margin: 50px; color: #000; }
        .header { text-align: center; font-weight: bold; }
        .header h3, .header h4 { margin: 0; }
        .info { margin-top: 20px; }
        .info table { width: 100%; border-collapse: collapse; }
        .info td { padding: 4px 0; vertical-align: top; }
        .signature { margin-top: 60px; text-align: right; }
        .tembusan { margin-top: 40px; font-size: 14px; }
        hr { border: 1px solid #000; margin: 10px 0; }
    </style>
</head>
<body>

<div class="header">
    <h3>KEMENTERIAN HUKUM DAN HAK ASASI MANUSIA REPUBLIK INDONESIA</h3>
    <h4>KANTOR WILAYAH KALIMANTAN SELATAN</h4>
    <p>Jalan Brigjend H. Hasan Basri No. 30 Banjarmasin, Kalimantan Selatan<br>
    Telepon/Fax : 0511-3302790 | Website : kalsel.kemenkumham.go.id | Email : kanwilkalsel@kemenkumham.go.id</p>
    <hr>
</div>

<p style="text-align:right;">Banjarmasin, {{ now()->format('d F Y') }}</p>
<p>Nomor: W.19-KP.04.04-{{ rand(1000,9999) }}<br>
Lampiran: -<br>
Hal: Kenaikan Gaji Berkala a.n. <strong>{{ $pegawai->nama }}</strong></p>

<p>Yth. Kepala Kantor Pelayanan Perbendaharaan Negara<br>di Banjarmasin</p>

<p>Dengan ini diberitahukan bahwa telah dipenuhinya masa kerja dan syarat-syarat lainnya kepada:</p>

<div class="info">
    <table>
        <tr><td>1.</td><td>Nama</td><td>: {{ $pegawai->nama }}</td></tr>
        <tr><td>2.</td><td>NIP</td><td>: {{ $pegawai->NIP }}</td></tr>
        <tr><td>3.</td><td>Pangkat / Jabatan</td><td>: {{ optional($pegawai->jabatan)->nama_jabatan }}</td></tr>
        <tr><td>4.</td><td>Unit Kerja</td><td>: Kantor Wilayah Kementerian Hukum dan HAM Kalimantan Selatan</td></tr>
        <tr><td>5.</td><td>Gaji Pokok Lama</td><td>: Rp. {{ number_format($pegawai->gaji_pokok_lama, 0, ',', '.') }},-</td></tr>
    </table>
</div>

<p>Atas dasar surat keputusan terakhir tentang penyesuaian gaji pokok yang ditetapkan:</p>

<div class="info">
    <table>
        <tr><td>a.</td><td>Oleh</td><td>: {{ optional($pegawai->pejabat)->nama_pejabat }}</td></tr>
        <tr><td>b.</td><td>Nomor</td><td>: {{ $pegawai->nomor_surat }}</td></tr>
        <tr><td>c.</td><td>Tanggal</td><td>: {{ date('d F Y', strtotime($pegawai->tanggal_surat)) }}</td></tr>
        <tr><td>d.</td><td>TMT Gaji Tersebut</td><td>: {{ date('d F Y', strtotime($pegawai->tmt_gaji_baru)) }}</td></tr>
        <tr><td>e.</td><td>Masa Kerja pada Tanggal Tersebut</td><td>: {{ $pegawai->masa_kerja_baru_thn }} Tahun {{ $pegawai->masa_kerja_baru_bln }} Bulan</td></tr>
    </table>
</div>

<p>Diberikan Kenaikan Gaji Berkala hingga memperoleh:</p>

<div class="info">
    <table>
        <tr><td>6.</td><td>Gaji Pokok Baru</td><td>: Rp. {{ number_format($pegawai->gaji_pokok_baru, 0, ',', '.') }},-</td></tr>
        <tr><td>7.</td><td>Berdasarkan Masa Kerja</td><td>: {{ $pegawai->masa_kerja_baru_thn + 2 }} Tahun {{ $pegawai->masa_kerja_baru_bln }} Bulan</td></tr>
        <tr><td>8.</td><td>Dalam Golongan</td><td>: {{ optional($pegawai->golongan)->nama_gol_pangkat }}</td></tr>
        <tr><td>9.</td><td>Mulai Tanggal</td><td>: {{ date('d F Y', strtotime($pegawai->tmt_kgb_berikutnya)) }}</td></tr>
    </table>
</div>

<p>Diharap agar sesuai dengan peraturan yang berlaku, pegawai tersebut dapat dibayarkan penghasilannya berdasarkan gaji pokok tersebut.</p>

<div class="signature">
    <p><strong>Kepala Kantor Wilayah</strong><br><br><br>
    <u>{{ optional($pegawai->pejabat)->nama_pejabat ?? '_________________' }}</u></p>
</div>

<div class="tembusan">
    <p><strong>Tembusan:</strong><br>
    1. Pembuat daftar gaji yang bersangkutan;<br>
    2. Pegawai Negeri Sipil yang bersangkutan.</p>
</div>

</body>
</html>
