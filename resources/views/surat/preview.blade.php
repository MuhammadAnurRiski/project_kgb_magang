{{-- ✅ Surat KGB Rapi & Siap Cetak PDF --}}
<div style="width: 600px; margin: 0 auto; font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #000;">

 {{-- KOP SURAT --}}
<div style="position: relative; margin-bottom: 20px;">

    @php
        $logo = null;
        $path = public_path('storage/' . $pengaturan->logo_instansi);
        if (file_exists($path)) {
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = base64_encode(file_get_contents($path));
            $logo = 'data:image/' . $type . ';base64,' . $data;
        }
    @endphp

    {{-- Logo di kiri --}}
    @if(!empty($logo))
        <img src="{{ $logo }}" 
             alt="Logo Instansi" 
             style="width: 85px; position: absolute; left: 8px; top: -5;">
    @endif

    {{-- Teks kop di tengah --}}
    <div style="text-align: center; line-height: 1.3;">
        <p style="font-size: 14px; font-weight: bold; margin: 0;">
            {{ strtoupper($pengaturan->nama_instansi) }}
        </p>
        <p style="font-size: 14px; font-weight: bold; margin: 0;">
            KANTOR WILAYAH KALIMANTAN SELATAN
        </p>
        <p style="font-size: 11px; margin: 2px 0 0 0; line-height: 1.4;">
            {!! nl2br(e($pengaturan->alamat_instansi)) !!}
        </p>
    </div>

    <hr style="border: 1px solid #000; margin-top: 8px; margin-bottom: 10px;">
</div>

{{-- HEADER SURAT --}}
<table style="width: 100%; font-size: 12px; margin-bottom: 15px; border-collapse: collapse;">
  <tr>
    <td style="width: 12%; vertical-align: top;">Nomor</td>
    <td style="width: 1%; vertical-align: top;">:</td>
    <td style="width: 47%; vertical-align: top;">
      <span id="nomor_surat">{{ $surat->nomor_surat ?? '..................' }}</span>
    </td>
    <td style="text-align: right; vertical-align: top;">
      {{ \Carbon\Carbon::parse($surat->tanggal_surat ?? now())->translatedFormat('d F Y') }}
    </td>
  </tr>
  <tr>
    <td>Lampiran</td>
    <td>:</td>
    <td>-</td>
    <td></td>
  </tr>
  <tr>
    <td>Hal</td>
    <td>:</td>
    <td><strong>Kenaikan Gaji Berkala a.n. {{ $pegawai->nama_pegawai }}</strong></td>
    <td></td>
  </tr>
</table>


  <p style="font-size: 12px;">Yth. Kepala Kantor Pelayanan Perbendaharaan Negara<br>di <strong>Banjarmasin</strong></p>

  <p style="font-size: 12px; text-align: justify;">
    Dengan ini diberitahukan bahwa telah dipenuhinya masa kerja dan syarat-syarat lainnya kepada:
  </p>

  {{-- IDENTITAS PEGAWAI --}}
  <table style="font-size: 12px; width: 100%; margin-left: 25px; line-height: 1.6;">
    <tr><td style="width: 25px;">1.</td><td style="width: 160px;">Nama</td><td>:</td><td>{{ $pegawai->nama_pegawai }}</td></tr>
    <tr><td>2.</td><td>NIP</td><td>:</td><td>{{ $pegawai->nip }}</td></tr>
    <tr><td>3.</td><td>Pangkat / Golongan</td><td>:</td><td>{{ $pegawai->pangkat_golongan }}</td></tr>
    <tr><td>4.</td><td>Unit Kerja</td><td>:</td><td>{{ $surat->unit_kerja ?? 'Kantor Wilayah Kementerian Hukum Kalimantan Selatan' }}</td></tr>
    <tr><td>5.</td><td>Gaji Pokok Lama</td><td>:</td><td>Rp {{ number_format($pegawai->nominal_gaji, 0, ',', '.') }},-</td></tr>
  </table>

  <p style="font-size: 12px; text-align: justify; margin-top: 15px;">
    Atas dasar surat keputusan terakhir tentang penyesuaian gaji pokok yang ditetapkan:
  </p>

  {{-- DATA SK TERAKHIR --}}
  <table style="font-size: 12px; width: 100%; margin-left: 25px; line-height: 1.6;">
    <tr><td style="width: 25px;">a.</td><td style="width: 160px;">Oleh</td><td>:</td><td>{{ $surat->oleh ?? 'Kepala Kantor Wilayah Kementerian Hukum Kalimantan Selatan' }}</td></tr>
    <tr><td>b.</td><td>Nomor</td><td>:</td><td>{{ $surat->nomor_surat ?? '..................' }}</td></tr>
    <tr><td>c.</td><td>Tanggal</td><td>:</td><td>{{ \Carbon\Carbon::parse($surat->tanggal_sk ?? now())->translatedFormat('d F Y') }}</td></tr>
    <tr><td>d.</td><td>Tanggal mulai berlaku gaji tersebut</td><td>:</td><td>{{ \Carbon\Carbon::parse($surat->tmt_gaji ?? now())->translatedFormat('d F Y') }}</td></tr>
    <tr><td>e.</td><td>Masa Kerja Golongan</td><td>:</td><td>{{ $pegawai->masa_kerja_tahun }} Tahun {{ $pegawai->masa_kerja_bulan }} Bulan</td></tr>
  </table>

  <p style="font-size: 12px; text-align: justify; margin-top: 15px;">
    Diberikan Kenaikan Gaji Berkala, hingga memperoleh:
  </p>

  {{-- DATA KGB BARU --}}
  <table style="font-size: 12px; width: 100%; margin-left: 25px; line-height: 1.6;">
    <tr><td style="width: 25px;">6.</td><td style="width: 160px;">Gaji Pokok Baru</td><td>:</td><td>Rp {{ number_format($pegawai->nominal_gaji_baru, 0, ',', '.') }},-</td></tr>
    <tr><td>7.</td><td>Berdasarkan Masa Kerja</td><td>:</td><td>{{ $pegawai->masa_kerja_selanjutnya_tahun }} Tahun {{ $pegawai->masa_kerja_selanjutnya_bulan }} Bulan</td></tr>
    <tr><td>8.</td><td>Dalam Golongan</td><td>:</td><td><span id="nama_golongan">{{ $surat->nama_golongan ?? '..................' }}</span></td></tr>
    <tr><td>9.</td><td>Mulai Tanggal</td><td>:</td><td>{{ \Carbon\Carbon::parse($pegawai->mulai_kgb ?? now())->translatedFormat('d F Y') }}</td></tr>
    <tr><td>10.</td><td>Kenaikan gaji berkala yang akan datang</td><td>:</td><td>{{ \Carbon\Carbon::parse($pegawai->kgb_selanjutnya ?? now())->translatedFormat('d F Y') }}</td></tr>
  </table>

  <p style="font-size: 12px; text-align: justify; margin-top: 15px;">
    Diharap agar sesuai dengan Peraturan Pemerintah <strong>Nomor 5 Tahun 2024</strong> kepada pegawai tersebut dapat dibayarkan penghasilannya berdasarkan gaji pokok tersebut.
  </p>

 {{-- TANDA TANGAN --}}
<div style="width: 100%; margin-top: 10px; font-size: 12px;">
  <div style="width: 250px; float: right; text-align: left; line-height: 1.2;">
    <p style="margin: 0;">
      Banjarmasin, {{ \Carbon\Carbon::parse($surat->tanggal_surat ?? now())->translatedFormat('d F Y') }}
    </p>
    <p style="margin: 2px 0 8px 0;">
      {{ $pegawai->jabatan_pejabat_penetap ?? 'Kepala Kantor Wilayah,' }}
    </p>
    @php
    $tandatangan = null;

    if (!empty($pengaturan->tanda_tangan)) {
        $path = asset('storage/' . $pengaturan->tanda_tangan);

        if (file_exists($path)) {
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = base64_encode(file_get_contents($path));
            $tandatangan = 'data:image/' . $type . ';base64,' . $data;
        }
    }
@endphp
    @if(!empty($tandatangan))
      <div style="margin: 0 auto 2px auto; text-align: center;">
        <img src="{{ $tandatangan }}" 
             alt="Tanda Tangan Pejabat"
             style="width: 85px; height: auto;">
      </div>
    @endif
      <br><br><br>
    <p style="font-weight: bold; text-decoration: margin: 0;">
      {{ $pegawai->pejabat_penetap }}
    </p>
  </div>
</div>


  {{-- TEMBUSAN --}}
  <div style="clear: both; margin-top: 100px; font-size: 12px;">
    <strong>Tembusan:</strong><br>
    1. Pembuat Daftar Gaji yang bersangkutan<br>
    2. Pegawai Negeri Sipil yang bersangkutan
  </div>
</div>
