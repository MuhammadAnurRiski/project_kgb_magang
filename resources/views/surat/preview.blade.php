{{-- ✅ Surat KGB Rapi & Siap Cetak PDF --}}
<div style="width: 620px; margin: 0 auto; font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: #000;">

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
             style="width: 85px; position: absolute; left: 5px; top: 1;">
    @endif

    {{-- Teks kop di tengah --}}
    <div style="text-align: center; line-height: 1.3; margin-right: -25px;">
        <p style="font-size: 14px; font-weight: bold; margin: 0;">
            {{ strtoupper($pengaturan->nama_instansi) }}
        </p>
        <p style="font-size: 14px; font-weight: bold; margin: 0;">
            KANTOR WILAYAH KALIMANTAN SELATAN
        </p>
        <p style="font-size: 13px; margin: 2px 0 0 0; line-height: 1.3;">
            {!! nl2br(e($pengaturan->alamat_instansi)) !!}
        </p>
    </div>

    <hr style="border: 1px solid #000; margin-top: 8px; margin-bottom: 10px;">
</div>

{{-- HEADER SURAT --}}
<table style="width: 100%; font-size: 14px; margin-bottom: 12px; border-collapse: collapse;">
  <tr>
    <td style="width: 12%; vertical-align: top;">Nomor</td>
    <td style="width: 2%; vertical-align: top;">:</td>
    <td style="width: 60%; vertical-align: top;">
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
    <td>Kenaikan Gaji Berkala a.n. {{ $pegawai->nama_pegawai }}</td>
    <td></td>
  </tr>
</table>


  <p style="margin-top: 25px; font-size: 14px;">Yth. Kepala Kantor Pelayanan Perbendaharaan Negara<br>di Banjarmasin</p>

  <p style="margin-bottom: 20px; margin-top: 20px; width: 96%; font-size: 14px; text-align: justify;">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dengan ini diberitahukan bahwa telah dipenuhinya masa kerja dan syarat - syarat &nbsp;&nbsp;&nbsp;lainnya kepada:
  </p>

  {{-- IDENTITAS PEGAWAI --}}
  <table style="margin-top: -10px; font-size: 14px; width: 150%; margin-left: 0px; line-height: 1.2;">
    <tr><td style="width: 22px;">1.</td><td style="width: 175px;">Nama</td><td>:</td><td>{{ $pegawai->nama_pegawai }}</td></tr>
    <tr><td>2.</td><td>NIP</td><td>:</td><td>{{ $pegawai->nip }}</td></tr>
    <tr><td>3.</td><td>Pangkat / Golongan</td><td>:</td><td>{{ $pegawai->pangkat_golongan }}</td></tr>
    <tr><td>4.</td><td>Unit Kerja</td><td>:</td><td><span id="unit_kerja">{{ $surat->unit_kerja ?? '.............' }}</span></td></tr>
    <tr><td>5.</td><td>Gaji Pokok Lama</td><td>:</td><td>Rp {{ number_format($pegawai->nominal_gaji, 0, ',', '.') }},-</td></tr>
  </table>

  <p style="width: 99%; font-size: 14px; text-align: justify; margin-top: 15px;">
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Atas dasar surat keputusan terakhir tentang penyesuaian gaji pokok yang ditetapkan:
  </p>

  {{-- DATA SK TERAKHIR --}}
  <table style="margin-top: -10px; font-size: 14px; width: 92%; margin-left: 25px; line-height: 1.2;">
    <tr><td style="width: 22px;">a.</td><td style="width: 150px;">Oleh</td><td>:</td><td style="width: 367px;"><span id="Oleh">{{ $surat->Oleh ?? '...............' }}</span></td></tr>
    <tr><td style="width: 22px;">b.</td><td style="width: 150px;">Nomor</td><td>:</td><td style="width: 367px;">{{ $pegawai->no_sk}}</td></tr>
    <tr><td style="width: 22px;">c.</td><td style="width: 150px;">Tanggal</td><td>:</td><td style="width: 367px;">{{ \Carbon\Carbon::parse($pegawai->tanggal ?? now())->translatedFormat('d F Y') }}</td></tr>
    <tr><td style="width: 22px;">d.</td><td style="width: 150px;">Tanggal mulai</td><td>:</td><td style="width: 367x;">{{ \Carbon\Carbon::parse($pegawai->tmt_kgb ?? now())->translatedFormat('d F Y') }}</td></tr>
     <tr>
  <td></td>
  <td style="padding-top: 0px; padding-left: 0px;">berlaku gaji tersebut</td>
</tr>
    <tr><td>e.</td><td>Masa Kerja Golongan</td><td>:</td><td>{{ $pegawai->masa_kerja_tahun }} Tahun {{ $pegawai->masa_kerja_bulan }} Bulan</td></tr>
  </table>

  <p style="font-size: 14px; text-align: justify; margin-top: 15px;">
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u>Diberikan Kenaikan Gaji Berkala, hingga memperoleh:</u>
  </p>

  {{-- DATA KGB BARU --}}
<table style="font-size: 14px; width: 80%; margin-left: 0px; line-height: 1.2;">
  <tr><td style="width: 23px;">6.</td><td style="width: 176px;">Gaji Pokok Baru</td><td>:</td><td>Rp {{ number_format($pegawai->nominal_gaji_baru, 0, ',', '.') }},-</td></tr>
  <tr><td style="width: 23px;">7.</td><td style="width: 176px;">Berdasarkan Masa Kerja</td><td>:</td><td>{{ $pegawai->mkg_tahun_selanjutnya }} Tahun {{ $pegawai->mkg_bulan_selanjutnya }} Bulan</td></tr>
  <tr><td style="width: 23px;">8.</td><td style="width: 176px;">Dalam Golongan</td><td>:</td><td><span id="nama_golongan">{{ $surat->nama_golongan ?? '..................' }}</span></td></tr>
  <tr><td style="width: 23px;">9.</td><td style="width: 176px;">Mulai Tanggal</td><td>:</td><td>{{ \Carbon\Carbon::parse($pegawai->tmt_pangkat_01 ?? now())->translatedFormat('d F Y') }}</td></tr>
  <tr><td style="width: 23px;">10.</td><td style="width: 176px;">Kenaikan gaji berkala</td><td>:</td><td>{{ \Carbon\Carbon::parse($pegawai->kgb_selanjutnya ?? now())->translatedFormat('d F Y') }}</td></tr>
  <tr>
    <td></td>
    <td style="padding-top: 0px; padding-left: 0px;">yang akan datang</td>
  </tr>
</table>

  <p style="width: 95%; font-size: 14px; text-align: justify; margin-top: 15px;">
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Diharap agar sesuai dengan Peraturan Pemerintah <strong>Nomor 5 Tahun 2024</strong> kepada &nbsp;&nbsp;&nbsp;Pegawai tersebut dapat dibayarkan penghasilannya berdasarkan gaji pokok tersebut.
  </p>

 {{-- TANDA TANGAN --}}
<div style="width: 100%; margin-top: 15px; font-size: 14px;">
  <div style="width: 250px; float: right; text-align: justify; line-height: 1.2;">
    <p style="padding-bottom: 55px; margin: 2px 0 8px 0;">
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $pegawai->jabatan_pejabat_penetap}}
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
             style="max-width: 48px; height: auto; margin-top: 5px;">
      </div>
    @endif
    <p style="width: 280px; margin: 0px;">
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $pegawai->pejabat_penetap }}
    </p>
  </div>
</div>

  {{-- TEMBUSAN --}}
  <div style="clear: both; margin-top: 40px; font-size: 13.5px;">
    <strong>Tembusan:</strong><br>
    1. Pembuat Daftar Gaji yang bersangkutan<br>
    2. Pegawai Negeri Sipil yang bersangkutan
  </div>
</div>
