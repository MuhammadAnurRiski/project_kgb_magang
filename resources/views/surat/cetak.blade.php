<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Surat Kenaikan Gaji Berkala</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Times New Roman', serif;
            background: #fff;
            color: #000;
        }

        .kop-surat {
            border-bottom: 3px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
            text-align: center;
        }

        .kop-surat h5 {
            font-weight: bold;
            margin-bottom: 2px;
        }

        .kop-surat h4 {
            font-weight: bold;
            text-transform: uppercase;
            margin-top: 2px;
        }

        .kop-surat p {
            margin: 0;
            font-size: 14px;
        }

        .judul-surat {
            text-align: center;
            margin: 30px 0 10px 0;
        }

        .judul-surat h5 {
            font-weight: bold;
            text-decoration: underline;
        }

        .judul-surat p {
            margin-top: -5px;
        }

        .content {
            font-size: 15px;
            line-height: 1.8;
        }

        .content table {
            width: 100%;
        }

        .content td {
            padding: 3px 0;
        }

        .footer {
            margin-top: 40px;
            text-align: right;
            font-size: 15px;
        }

        .tanda-tangan {
            margin-top: 80px;
            text-align: right;
        }

        .btn-print {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #1e1b4b;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            font-weight: 600;
        }

        .btn-print:hover {
            background-color: #3b2f7a;
        }

        @media print {
            .btn-print {
                display: none;
            }
        }
    </style>
</head>
<body>

<div class="container mt-4 mb-5">
    <!-- 🟢 KOP SURAT -->
    <div class="kop-surat">
        <h5>KEMENTERIAN HUKUM DAN HAK ASASI MANUSIA RI</h5>
        <h4>KANTOR WILAYAH KEMENKUMHAM KALIMANTAN TIMUR</h4>
        <p>Jl. M. Yamin No. 28 Samarinda Telp. (0541) 123456 Fax (0541) 654321</p>
    </div>

    <!-- 🟣 JUDUL SURAT -->
    <div class="judul-surat">
        <h5>SURAT KENAIKAN GAJI BERKALA</h5>
        <p>Nomor: {{ $surat->nomor_surat ?? '......' }}</p>
    </div>

    <!-- 🔹 ISI SURAT -->
    <div class="content mt-4">
        <p>Yang bertanda tangan di bawah ini, berdasarkan Peraturan Pemerintah Nomor 12 Tahun 2002 tentang Kenaikan Gaji Berkala Pegawai Negeri Sipil, dengan ini memberikan Kenaikan Gaji Berkala kepada:</p>

        <table class="table table-borderless mt-2">
            <tr>
                <td style="width: 200px;">Nama</td>
                <td style="width: 10px;">:</td>
                <td><strong>{{ $surat->nama ?? '-' }}</strong></td>
            </tr>
            <tr>
                <td>NIP</td>
                <td>:</td>
                <td>{{ $surat->NIP ?? '-' }}</td>
            </tr>
            <tr>
                <td>Pangkat / Gol. Ruang</td>
                <td>:</td>
                <td>{{ optional($surat->golongan)->nama_gol_pangkat ?? '-' }}</td>
            </tr>
            <tr>
                <td>Jabatan</td>
                <td>:</td>
                <td>{{ optional($surat->jabatan)->nama_jabatan ?? '-' }}</td>
            </tr>
            <tr>
                <td>Unit Kerja</td>
                <td>:</td>
                <td>{{ optional($surat->unitKerja)->nama_unit ?? '-' }}</td>
            </tr>
            <tr>
                <td>Gaji Pokok Lama</td>
                <td>:</td>
                <td>Rp {{ number_format($surat->gaji_pokok_lama ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Gaji Pokok Baru</td>
                <td>:</td>
                <td>Rp {{ number_format($surat->gaji_pokok_baru ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>TMT KGB Berikutnya</td>
                <td>:</td>
                <td>{{ $surat->tmt_kgb_berikutnya ? date('d F Y', strtotime($surat->tmt_kgb_berikutnya)) : '-' }}</td>
            </tr>
        </table>

        <p>Dengan kenaikan gaji berkala ini, maka yang bersangkutan berhak menerima gaji pokok sebesar tersebut di atas mulai tanggal
            <strong>{{ $surat->tmt_gaji_baru ? date('d F Y', strtotime($surat->tmt_gaji_baru)) : '-' }}</strong>.
        </p>

        <div class="footer">
            <p>Ditetapkan di: Samarinda</p>
            <p>Pada tanggal: {{ $surat->tanggal_surat ? date('d F Y', strtotime($surat->tanggal_surat)) : '...................' }}</p>
        </div>

        <div class="tanda-tangan">
            <p><strong>{{ optional($surat->pejabat)->nama_pejabat ?? 'Pejabat Penetap' }}</strong></p>
            <p>NIP. {{ optional($surat->pejabat)->nip_pejabat ?? '-' }}</p>
        </div>
    </div>
</div>

<!-- 🖨️ Tombol Cetak -->
<button class="btn-print" onclick="window.print()">
    <i class="fas fa-print me-2"></i> Cetak Surat
</button>

<script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>
</html>
