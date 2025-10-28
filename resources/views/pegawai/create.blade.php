@extends('layouts.blank')

@section('title', 'Tambah Data Pegawai')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        {{-- Header Hijau --}}
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Tambah Data Pegawai</h5>
            <a href="{{ route('pegawai.index') }}" class="text-white text-decoration-none fs-4" style="opacity: 0.7;">×</a>
        </div>

        {{-- FORM START --}}
        <form action="{{ route('pegawai.store') }}" method="POST" class="p-4">
            @csrf

            {{-- ========================= BAGIAN 1 : DATA UTAMA PEGAWAI ========================= --}}
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="fw-bold">Nama</label>
                    <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama..." required>
                </div>

                <div class="col-md-6">
                    <label class="fw-bold">Masa Kerja</label>
                    <div class="d-flex gap-2">
                        <select name="masa_kerja_tahun" class="form-select" required>
                            <option value="">Pilih Tahun...</option>
                            @for ($i = 0; $i <= 33; $i++)
                                <option value="{{ $i }}">{{ $i }} Tahun</option>
                            @endfor
                        </select>
                        <select name="masa_kerja_bulan" class="form-select" required>
                            <option value="">Pilih Bulan...</option>
                            @for ($i = 0; $i <= 11; $i++)
                                <option value="{{ $i }}">{{ $i }} Bulan</option>
                            @endfor
                        </select>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="fw-bold">NIP</label>
                    <input type="text" name="NIP" class="form-control" placeholder="Masukkan NIP..." required>
                </div>

                <div class="col-md-6">
                    <label class="fw-bold">Nominal Gaji</label>
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="text" name="gaji_pokok_baru" class="form-control" placeholder="Rp.xxx.xxx" required>
                    </div>
                </div>
            </div>
    
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="fw-bold">Jabatan</label>
                    <select name="id_jabatan" class="form-select" required>
                        <option value="">Pilih Jabatan...</option>
                        @foreach ($jabatans as $jab)
                            <option value="{{ $jab->id_jabatan }}">{{ $jab->nama_jabatan }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="fw-bold">No. SK</label>
                    <input type="text" name="nomor_surat" class="form-control" placeholder="Masukkan No. SK..." required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="fw-bold">Pangkat/Gol. Ruang</label>
                    <select name="id_gol_pangkat" class="form-select" required>
                        <option value="">Pilih Pangkat/Gol. Ruang...</option>
                        @foreach ($golongans as $gol)
                            <option value="{{ $gol->id_gol_pangkat }}">{{ $gol->nama_gol_pangkat }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="fw-bold">Pejabat Penetap</label>
                    <select name="id_pejabat" class="form-select" required>
                        <option value="">Pilih Pejabat Penetap...</option>
                        @foreach ($pejabats as $pej)
                            <option value="{{ $pej->id_pejabat }}">{{ $pej->nama_pejabat }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <label class="fw-bold">TMT Pangkat</label>
                    <input type="date" name="tmt_gaji_baru" class="form-control" required>
                </div>
            </div>

            {{-- ======== PEMBATAS ANTARA DATA PEGAWAI DAN DATA KGB ======== --}}
            <hr class="my-4 border-2 border-dark">
            <h6 class="fw-bold fst-italic text-secondary mb-3">Data Kenaikan Gaji Berkala</h6>

            {{-- ========================= BAGIAN 2 : DATA KGB ========================= --}}
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="fw-bold">TMT KGB</label>
                    <input type="date" name="tmt_kgb" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label class="fw-bold">Nomor Surat KGB</label>
                    <input type="text" name="nomor_surat_kgb" class="form-control" placeholder="Masukkan Nomor Surat KGB..." required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="fw-bold">Pangkat/Gol. Ruang KGB</label>
                    <select name="id_gol_pangkat_kgb" class="form-select" required>
                        <option value="">Pilih Pangkat/Gol. Ruang KGB...</option>
                        @foreach ($golongans as $gol)
                            <option value="{{ $gol->id_gol_pangkat }}">{{ $gol->nama_gol_pangkat }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="fw-bold">Pejabat Penetap KGB</label>
                    <select name="id_pejabat_kgb" class="form-select" required>
                        <option value="">Pilih Pejabat Penetap...</option>
                        @foreach ($pejabats as $pej)
                            <option value="{{ $pej->id_pejabat }}">{{ $pej->nama_pejabat }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- 🔹 Tambahan: Masa Kerja KGB, Gaji & KGB Selanjutnya (tanpa jarak tambahan) --}}
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="fw-bold">Masa Kerja (KGB)</label>
                    <div class="d-flex gap-2">
                        <select name="masa_kerja_kgb_tahun" class="form-select" required>
                            <option value="">Pilih Tahun...</option>
                            @for ($i = 0; $i <= 33; $i++)
                                <option value="{{ $i }}">{{ $i }} Tahun</option>
                            @endfor
                        </select>
                        <select name="masa_kerja_kgb_bulan" class="form-select" required>
                            <option value="">Pilih Bulan...</option>
                            @for ($i = 0; $i <= 11; $i++)
                                <option value="{{ $i }}">{{ $i }} Bulan</option>
                            @endfor
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="fw-bold">KGB Selanjutnya</label>
                    <input type="date" name="tmt_kgb_berikutnya" class="form-control" required>
                </div>
            </div>

            {{-- 🔹 Gaji (dipindah ke bawah agar lebih rapi) --}}
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="fw-bold">Nominal Gaji</label>
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="text" name="gaji_pokok_lama" class="form-control" placeholder="Rp.xxx.xxx" required>
                    </div>
                </div>
            </div>

            {{-- ========================= BUTTON SIMPAN ========================= --}}
            <div class="text-end mt-4">
                <button type="submit" class="btn btn-success px-4">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
