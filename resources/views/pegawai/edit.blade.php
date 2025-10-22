@extends('layouts.app')

@section('title', 'Edit Data Pegawai')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        {{-- Header Oranye --}}
        <div class="card-header bg-warning text-white">
            <h5 class="mb-0">Edit Data Pegawai</h5>
        </div>

        {{-- FORM START --}}
        <form action="{{ route('pegawai.update', $pegawai->id_sk ?? $pegawai->id) }}" method="POST" class="p-4">
            @csrf
            @method('PUT')

            {{-- ========================= BAGIAN 1 : DATA UTAMA PEGAWAI ========================= --}}
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="fw-bold">Nama</label>
                    <input type="text" name="nama" class="form-control" value="{{ old('nama', $pegawai->nama ?? '') }}" required>
                </div>

                <div class="col-md-6">
                    <label class="fw-bold">Masa Kerja</label>
                    <div class="d-flex gap-2">
                        <select name="masa_kerja_tahun" class="form-select" required>
                            <option value="">Pilih Tahun...</option>
                            @for ($i = 0; $i <= 40; $i++)
                                <option value="{{ $i }}" {{ old('masa_kerja_tahun', $pegawai->masa_kerja_tahun ?? 0) == $i ? 'selected' : '' }}>
                                    {{ $i }} Tahun
                                </option>
                            @endfor
                        </select>
                        <select name="masa_kerja_bulan" class="form-select" required>
                            <option value="">Pilih Bulan...</option>
                            @for ($i = 0; $i <= 11; $i++)
                                <option value="{{ $i }}" {{ old('masa_kerja_bulan', $pegawai->masa_kerja_bulan ?? 0) == $i ? 'selected' : '' }}>
                                    {{ $i }} Bulan
                                </option>
                            @endfor
                        </select>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="fw-bold">NIP</label>
                    <input type="text" name="NIP" class="form-control" value="{{ old('NIP', $pegawai->NIP ?? '') }}" required>
                </div>

                <div class="col-md-6">
                    <label class="fw-bold">Nominal Gaji</label>
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="text" name="gaji_pokok_baru" class="form-control" value="{{ old('gaji_pokok_baru', $pegawai->gaji_pokok_baru ?? '') }}" required>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="fw-bold">Jabatan</label>
                    <select name="id_jabatan" class="form-select" required>
                        <option value="">Pilih Jabatan...</option>
                        @foreach ($jabatans as $jab)
                            <option value="{{ $jab->id_jabatan }}" {{ (old('id_jabatan', $pegawai->id_jabatan ?? '') == $jab->id_jabatan) ? 'selected' : '' }}>
                                {{ $jab->nama_jabatan }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="fw-bold">No. SK</label>
                    <input type="text" name="nomor_surat" class="form-control" value="{{ old('nomor_surat', $pegawai->nomor_surat ?? '') }}">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="fw-bold">Pangkat/Gol. Ruang</label>
                    <select name="id_gol_pangkat" class="form-select" required>
                        <option value="">Pilih Pangkat/Gol. Ruang...</option>
                        @foreach ($golongans as $gol)
                            <option value="{{ $gol->id_gol_pangkat }}" {{ (old('id_gol_pangkat', $pegawai->id_gol_pangkat ?? '') == $gol->id_gol_pangkat) ? 'selected' : '' }}>
                                {{ $gol->nama_gol_pangkat }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="fw-bold">Pejabat Penetap</label>
                    <select name="id_pejabat" class="form-select" required>
                        <option value="">Pilih Pejabat Penetap...</option>
                        @foreach ($pejabats as $pej)
                            <option value="{{ $pej->id_pejabat }}" {{ (old('id_pejabat', $pegawai->id_pejabat ?? '') == $pej->id_pejabat) ? 'selected' : '' }}>
                                {{ $pej->nama_pejabat }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <label class="fw-bold">TMT Pangkat</label>
                    <input type="date" name="tmt_gaji_baru" class="form-control" value="{{ old('tmt_gaji_baru', $pegawai->tmt_gaji_baru ?? '') }}">
                </div>
            </div>

            {{-- PEMBATAS ANTARA DATA PEGAWAI DAN KGB --}}
            <hr class="my-4 border-2 border-dark">
            <h6 class="fw-bold fst-italic text-secondary mb-3">Data Kenaikan Gaji Berkala</h6>

            {{-- BAGIAN 2 : DATA KGB --}}
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="fw-bold">TMT KGB</label>
                    <input type="date" name="tmt_kgb" class="form-control" value="{{ old('tmt_kgb', $pegawai->tmt_kgb ?? '') }}">
                </div>

                <div class="col-md-6">
                    <label class="fw-bold">Nomor Surat KGB</label>
                    <input type="text" name="nomor_surat_kgb" class="form-control" value="{{ old('nomor_surat_kgb', $pegawai->nomor_surat_kgb ?? '') }}">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="fw-bold">Pangkat/Gol. Ruang KGB</label>
                    <select name="id_gol_pangkat_kgb" class="form-select">
                        <option value="">Pilih Pangkat/Gol. Ruang KGB...</option>
                        @foreach ($golongans as $gol)
                            <option value="{{ $gol->id_gol_pangkat }}" {{ (old('id_gol_pangkat_kgb', $pegawai->id_gol_pangkat_kgb ?? '') == $gol->id_gol_pangkat) ? 'selected' : '' }}>
                                {{ $gol->nama_gol_pangkat }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="fw-bold">Pejabat Penetap KGB</label>
                    <select name="id_pejabat_kgb" class="form-select">
                        <option value="">Pilih Pejabat Penetap...</option>
                        @foreach ($pejabats as $pej)
                            <option value="{{ $pej->id_pejabat }}" {{ (old('id_pejabat_kgb', $pegawai->id_pejabat_kgb ?? '') == $pej->id_pejabat) ? 'selected' : '' }}>
                                {{ $pej->nama_pejabat }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- Posisi ditukar: Nominal Gaji dulu baru KGB Selanjutnya --}}
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="fw-bold">Nominal Gaji</label>
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="text" name="gaji_pokok_lama" class="form-control" value="{{ old('gaji_pokok_lama', $pegawai->gaji_pokok_lama ?? '') }}">
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="fw-bold">KGB Selanjutnya</label>
                    <input type="date" name="tmt_kgb_berikutnya" class="form-control" value="{{ old('tmt_kgb_berikutnya', $pegawai->tmt_kgb_berikutnya ?? '') }}">
                </div>
            </div>

            {{-- BUTTONS --}}
            <div class="text-end mt-4">
                <a href="{{ route('pegawai.index') }}" class="btn btn-danger">
                    <i class="fas fa-times"></i> Batal
                </a>
                <button type="submit" class="btn btn-success px-4">
                    <i class="fas fa-save"></i> Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
