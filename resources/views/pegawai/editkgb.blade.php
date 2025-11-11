@extends('layouts.app')

@section('title', 'Edit KGB Pegawai')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm border-0">
        <div class="card-header" style="background-color:#2e2f6e; color:white;">
            <h5 class="mb-0"><i class="fas fa-money-check-alt"></i> Edit Data Kenaikan Gaji Berkala (KGB)</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('pegawai.updatekgb', $pegawai->id_pegawai) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <!-- Tanggal KGB Sekarang -->
                    <div class="col-md-6 mb-3">
                        <label class="fw-semibold text-secondary">Tanggal Kgb Sekarang</label>
                        <input type="date" name="tmt_kgb" class="form-control" 
                            value="{{ old('tmt_kgb', $pegawai->tmt_kgb) }}" required>
                    </div>

                    <!-- Gaji Pokok Lama -->
                    <div class="col-md-6 mb-3">
                        <label class="fw-semibold text-secondary">Gaji Pokok Lama</label>
                        <input list="gajiList" name="nominal_gaji" class="form-control" 
                            value="{{ old('nominal_gaji', $pegawai->nominal_gaji) }}" placeholder="Ketik atau pilih nominal gaji" required>
                        <datalist id="gajiList">
                            @foreach ($gajiOptions as $opt)
                                <option value="Rp {{ number_format($opt, 0, ',', '.') }}"></option>
                            @endforeach
                        </datalist>
                    </div>

                    <!-- Gaji Pokok Baru -->
                    <div class="col-md-6 mb-3">
                        <label class="fw-semibold text-secondary">Gaji Pokok Baru</label>
                        <input list="gajiList" name="nominal_gaji_baru" class="form-control" 
                            value="{{ old('nominal_gaji_baru', $pegawai->nominal_gaji_baru) }}" placeholder="Ketik atau pilih nominal gaji" required>
                    </div>

                    <!-- Nomor SK -->
                    <div class="col-md-6 mb-3">
                        <label class="fw-semibold text-secondary">Nomor SK</label>
                        <input type="text" name="no_sk" class="form-control" 
                            value="{{ old('no_sk', $pegawai->no_sk) }}" required>
                    </div>

                    <!-- Masa Kerja Tahun -->
                    <div class="col-md-6 mb-3">
                        <label class="fw-semibold text-secondary">Masa Kerja (Tahun)</label>
                        <input type="number" name="masa_kerja_tahun" class="form-control" 
                            value="{{ old('masa_kerja_tahun', $pegawai->masa_kerja_tahun) }}" required>
                    </div>

                    <!-- Masa Kerja Bulan -->
                    <div class="col-md-6 mb-3">
                        <label class="fw-semibold text-secondary">Masa Kerja (Bulan)</label>
                        <input type="number" name="masa_kerja_bulan" class="form-control" 
                            value="{{ old('masa_kerja_bulan', $pegawai->masa_kerja_bulan) }}" required>
                    </div>

                    <!-- Tanggal KGB Sebelumnya (TMT Pangkat) -->
                    <div class="col-md-6 mb-3">
                        <label class="fw-semibold text-secondary">Tanggal KGB Sebelumnya</label>
                        <input type="date" name="tmt_pangkat_01" class="form-control" 
                            value="{{ old('tmt_pangkat_01', $pegawai->tmt_pangkat_01) }}">
                    </div>

                    <!-- Tanggal -->
                    <div class="col-md-6 mb-3">
                        <label class="fw-semibold text-secondary">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" 
                            value="{{ old('tanggal', $pegawai->tanggal) }}" required>
                    </div>

                    <!-- Masa Kerja Tahun Selanjutnya -->
                    <div class="col-md-6 mb-3">
                        <label class="fw-semibold text-secondary">Masa Kerja (Tahun) Selanjutnya</label>
                        <input type="number" name="mkg_tahun_selanjutnya" class="form-control" 
                            value="{{ old('masa_kerja_tahun', $pegawai->mkg_tahun_selanjutnya) }}" required>
                    </div>

                    <!-- Masa Kerja Bulan Selanjutnya -->
                    <div class="col-md-6 mb-3">
                        <label class="fw-semibold text-secondary">Masa Kerja (Bulan) Selanjutnya</label>
                        <input type="number" name="mkg_bulan_selanjutnya" class="form-control" 
                            value="{{ old('masa_kerja_bulan', $pegawai->mkg_bulan_selanjutnya) }}" required>
                    </div>

                    <!-- Pejabat Penetap -->
                    <div class="col-md-6 mb-3">
                        <label class="fw-semibold text-secondary">Pejabat Penetap</label>
                        <input type="text" name="pejabat_penetap" class="form-control" 
                            value="{{ old('pejabat_penetap', $pegawai->pejabat_penetap) }}" required>
                    </div>

                    <!-- Jabatan Pejabat Penetap -->
                    <div class="col-md-6 mb-3">
                        <label class="fw-semibold text-secondary">Jabatan Pejabat Penetap</label>
                        <input type="text" name="jabatan_pejabat_penetap" class="form-control" 
                            value="{{ old('pejabat_penetap', $pegawai->jabatan_pejabat_penetap) }}" required>
                    </div>

                    <!-- KGB Selanjutnya -->
                    <div class="col-md-6 mb-3">
                        <label class="fw-semibold text-secondary">Tanggal KGB Selanjutnya</label>
                        <input type="date" name="kgb_selanjutnya" class="form-control" 
                            value="{{ old('kgb_selanjutnya', $pegawai->kgb_selanjutnya) }}" required> 
                    </div>
                </div>

                <hr class="my-4">

                <div class="d-flex justify-content-between">
                    <a href="{{ route('pegawai.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Simpan Perubahan KGB
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    label {
        font-size: 0.95rem;
    }

    .form-control {
        border-radius: 10px;
    }

    .btn {
        border-radius: 8px;
    }

    .card {
        border-radius: 12px;
    }

    .row.g-3 {
        margin-left: 10px;
        margin-right: 10px;
    }
</style>

@endsection
