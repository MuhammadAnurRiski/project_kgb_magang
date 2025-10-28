@extends('layouts.blank')

@section('title', 'Detail Data Pegawai')

@section('content')
<style>
    /* ======== Custom Styling Agar 100% Mirip UI/UX ======== */
    .card-custom {
        border-radius: 6px;
        overflow: hidden;
    }
    .card-header {
        background-color: #007bff !important;
        color: #fff !important;
        font-weight: 600;
        padding: 10px 15px;
        display: flex;
        align-items: center;
    }
    .card-header i {
        margin-right: 8px;
    }
    .section-title {
        font-weight: 600;
        font-size: 14px;
        color: #444;
        margin-top: 25px;
        margin-bottom: 5px;
    }
    .section-subtitle {
        font-weight: 600;
        color: #007bff;
        margin-bottom: 12px;
        font-size: 14px;
    }
    label {
        font-weight: 600;
        font-size: 13px;
        margin-bottom: 4px;
    }
    input.form-control {
        background-color: #f2f4f7;
        border: 1px solid #d9d9d9;
        border-radius: 4px;
        font-size: 13px;
    }
    hr {
        border: none;
        border-top: 2px solid #eee;
        margin: 25px 0;
    }
    .btn-warning {
        background-color: #f59e0b !important;
        border: none;
        font-weight: 600;
    }
    .btn-danger {
        background-color: #ef4444 !important;
        border: none;
        font-weight: 600;
    }
    .card-footer {
        background-color: #f8f9fa;
        padding: 15px;
    }
</style>

<div class="container py-4">
    <div class="card shadow-sm card-custom">
        {{-- HEADER --}}
        <div class="card-header">
            <i class="fas fa-id-card"></i>
            <h5 class="mb-0">Detail Data Pegawai</h5>
        </div>

        {{-- BODY --}}
        <div class="card-body">
            {{-- IDENTITAS PEGAWAI --}}
            <div class="section-subtitle">Identitas Pegawai</div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label>Nama</label>
                    <input type="text" class="form-control" value="{{ strtoupper($pegawai->nama ?? '-') }}" readonly>
                </div>
                <div class="col-md-6">
                    <label>Masa Kerja</label>
                    <input type="text" class="form-control" 
                        value="{{ $pegawai->masa_kerja_baru_thn ?? 0 }} Tahun {{ $pegawai->masa_kerja_baru_bln ?? 0 }} Bulan" readonly>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label>NIP</label>
                    <input type="text" class="form-control" value="{{ $pegawai->NIP ?? '-' }}" readonly>
                </div>
                <div class="col-md-6">
                    <label>Nominal Gaji</label>
                    <input type="text" class="form-control" 
                        value="Rp {{ number_format($pegawai->gaji_pokok_baru ?? 0, 0, ',', '.') }}" readonly>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label>Jabatan</label>
                    <input type="text" class="form-control" value="{{ $pegawai->jabatan->nama_jabatan ?? '-' }}" readonly>
                </div>
                <div class="col-md-6">
                    <label>No. SK</label>
                    <input type="text" class="form-control" value="{{ $pegawai->nomor_surat ?? '-' }}" readonly>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label>Pangkat/Gol. Ruang</label>
                    <input type="text" class="form-control" value="{{ $pegawai->golongan->nama_gol_pangkat ?? '-' }}" readonly>
                </div>
                <div class="col-md-6">
                    <label>Pejabat Penetap</label>
                    <input type="text" class="form-control" value="{{ $pegawai->pejabat->nama_pejabat ?? '-' }}" readonly>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <label>TMT Pangkat</label>
                    <input type="text" class="form-control" 
                        value="{{ $pegawai->tanggal_surat ? date('d/m/Y', strtotime($pegawai->tanggal_surat)) : '-' }}" readonly>
                </div>
                <div class="col-md-6">
                    <label>&nbsp;</label>
                    <input type="text" class="form-control" readonly style="background: none; border: none;">
                </div>
            </div>

            <div class="section-subtitle mt-4">Data Kenaikan Gaji Berkala</div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label>TMT KGB</label>
                    <input type="text" class="form-control" 
                        value="{{ $pegawai->tmt_gaji_baru ? date('d/m/Y', strtotime($pegawai->tmt_gaji_baru)) : '-' }}" readonly>
                </div>
                <div class="col-md-6">
                    <label>Nomor Surat KGB</label>
                    <input type="text" class="form-control" value="{{ $pegawai->nomor_surat ?? '-' }}" readonly>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label>Pangkat/Gol. Ruang KGB</label>
                    <input type="text" class="form-control" value="{{ $pegawai->golongan->nama_gol_pangkat ?? '-' }}" readonly>
                </div>
                <div class="col-md-6">
                    <label>Pejabat Penetap KGB</label>
                    <input type="text" class="form-control" value="{{ $pegawai->pejabat->nama_pejabat ?? '-' }}" readonly>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label>KGB Selanjutnya</label>
                    <input type="text" class="form-control" 
                        value="{{ $pegawai->tmt_kgb_berikutnya ? date('d/m/Y', strtotime($pegawai->tmt_kgb_berikutnya)) : '-' }}" readonly>
                </div>
                <div class="col-md-6">
                    <label>Nominal Gaji</label>
                    <input type="text" class="form-control" 
                        value="Rp {{ number_format($pegawai->gaji_pokok_baru ?? 0, 0, ',', '.') }}" readonly>
                </div>
            </div>
        </div>

        {{-- FOOTER --}}
        <div class="card-footer text-end">
            <a href="{{ route('pegawai.edit', $pegawai->id_sk) }}" class="btn btn-warning me-2">
                <i class="fas fa-edit"></i> Edit
            </a>
            <form id="deleteForm" action="{{ route('pegawai.destroy', $pegawai->id_sk) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-trash"></i> Hapus
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
