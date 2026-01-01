@extends('layouts.app')
@section('title', 'Detail Data Pegawai')

@section('content')
<style>
    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: relative;
    }

    .btn-delete-top {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
    }

    .action-buttons a {
        margin-left: 10px;
    }

    h5.section-title {
        color: #2e2f6e;
        font-weight: 700;
        margin-top: 1rem;
        margin-bottom: 1rem;
        border-left: 5px solid #2e2f6e;
        padding-left: 10px;
    }

    .form-control[readonly] {
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 8px;
    }

    hr.section-divider {
        border-top: 2px dashed #bbb;
        margin: 30px 0;
    }
</style>

<div class="container-fluid">
    <div class="card shadow-sm border-0">
        <!-- Header -->
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Detail Data Pegawai</h5>
            <button class="btn btn-danger btn-sm px-3 btn-delete-top" id="btnHapus">
                <i class="fas fa-trash-alt me-1"></i> Hapus
            </button>
        </div>

        <div class="card-body px-4 py-4">
            
            <!-- ================= DATA UTAMA PEGAWAI ================= -->
            <h5 class="section-title">Data Utama Pegawai</h5>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="fw-semibold text-secondary">Nama</label>
                    <input type="text" class="form-control" value="{{ $pegawai->nama_pegawai }}" readonly>
                </div>
                <div class="col-md-6">
                    <label class="fw-semibold text-secondary">NIP</label>
                    <input type="text" class="form-control" value="{{ $pegawai->nip }}" readonly>
                </div>

                <div class="col-md-6">
                    <label class="fw-semibold text-secondary">Jabatan</label>
                    <input type="text" class="form-control" value="{{ $pegawai->jabatan }}" readonly>
                </div>
                <div class="col-md-6">
                    <label class="fw-semibold text-secondary">Pangkat / Golongan</label>
                    <input type="text" class="form-control" value="{{ $pegawai->pangkat_golongan }}" readonly>
                </div>
                <div class="col-md-6">
                    <label class="fw-semibold text-secondary">TMT Pangkat</label>
                    <input type="text" class="form-control" value="{{ $pegawai->tmt_pangkat ? \Carbon\Carbon::parse($pegawai->tmt_pangkat)->format('d-m-Y') : '-' }}" readonly>
                </div>
            </div>

            <hr class="section-divider">

            <!-- ================= DATA KGB ================= -->
            <h5 class="section-title text-success">Data KGB</h5>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="fw-semibold text-secondary">Mulai Tanggal</label>
                    <input type="text" class="form-control" value="{{ $pegawai->tmt_pangkat_01 ? \Carbon\Carbon::parse($pegawai->tmt_pangkat_01)->format('d-m-Y') : '-' }}" readonly>
                </div>

                <div class="col-md-6">
                    <label class="fw-semibold text-secondary">Tanggal Mulai Berlaku Gaji</label>
                    <input type="text" class="form-control" value="{{ $pegawai->tmt_kgb ? \Carbon\Carbon::parse($pegawai->tmt_kgb)->format('d-m-Y') : '-' }}" readonly>
                </div>

                <div class="col-md-6">
                    <label class="fw-semibold text-secondary">Gaji Pokok Lama</label>
                    <input type="text" class="form-control" value="Rp {{ number_format((int) preg_replace('/[^0-9.]/', '', $pegawai->nominal_gaji), 0, ',', '.') }}" readonly>
                </div>

                <div class="col-md-6">
                    <label class="fw-semibold text-secondary">Gaji Pokok Baru</label>
                    <input type="text" class="form-control" value="Rp {{ number_format((int) preg_replace('/[^0-9.]/', '', $pegawai->nominal_gaji_baru), 0, ',', '.') }}" readonly>
                </div>

                <div class="col-md-6">
                    <label class="fw-semibold text-secondary">Nomor Surat KGB</label>
                    <input type="text" class="form-control" value="{{ $pegawai->no_sk }}" readonly>
                </div>

                <div class="col-md-6">
                    <label class="fw-semibold text-secondary">Tanggal</label>
                    <input type="text" class="form-control" value="{{ $pegawai->tanggal ? \Carbon\Carbon::parse($pegawai->tanggal)->format('d-m-Y') : '-' }}" readonly>
                </div>

                <div class="col-md-6">
                    <label class="fw-semibold text-secondary">Pejabat Penetap</label>
                    <input type="text" class="form-control" value="{{ $pegawai->pejabat_penetap }}" readonly>
                </div>

                <div class="col-md-6">
                    <label class="fw-semibold text-secondary">Jabatan Pejabat Penetap</label>
                    <input type="text" class="form-control" value="{{ $pegawai->jabatan_pejabat_penetap }}" readonly>
                </div>

                <div class="col-md-6">
                    <label class="fw-semibold text-secondary">Masa Kerja (Tahun)</label>
                    <input type="text" class="form-control" value="{{ $pegawai->masa_kerja_tahun }}" readonly>
                </div>
                <div class="col-md-6">
                    <label class="fw-semibold text-secondary">Masa Kerja (Bulan)</label>
                    <input type="text" class="form-control" value="{{ $pegawai->masa_kerja_bulan }}" readonly>
                </div>

                <div class="col-md-6">
                    <label class="fw-semibold text-secondary">Masa Kerja Selanjutnya (Tahun)</label>
                    <input type="text" class="form-control" value="{{ $pegawai->mkg_tahun_selanjutnya }}" readonly>
                </div>

                <div class="col-md-6">
                    <label class="fw-semibold text-secondary">Masa Kerja Selanjutnya (Bulan)</label>
                    <input type="text" class="form-control" value="{{ $pegawai->mkg_bulan_selanjutnya }}" readonly>
                </div>

                <div class="col-md-6">
                    <label class="fw-semibold text-secondary">Tanggal KGB Selanjutnya</label>
                    <input type="text" class="form-control" value="{{ $pegawai->kgb_selanjutnya ? \Carbon\Carbon::parse($pegawai->kgb_selanjutnya)->format('d-m-Y') : '-' }}" readonly>
                </div>
            </div>

            <hr class="my-4">

            <!-- Tombol Aksi -->
            <div class="d-flex justify-content-between align-items-center">
                <a href="{{ route('pegawai.index') }}" class="btn btn-secondary px-4">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
                <div class="action-buttons d-flex">
                    <a href="{{ route('pegawai.edit', $pegawai->id_pegawai) }}" class="btn btn-warning px-4">
                        <i class="fas fa-edit me-1"></i> Edit Data
                    </a>
                    <a href="{{ route('pegawai.editkgb', $pegawai->id_pegawai) }}" class="btn btn-success px-4">
                        <i class="fas fa-edit me-1"></i> Edit KGB
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.getElementById('btnHapus').addEventListener('click', function () {
    Swal.fire({
        title: 'Yakin ingin menghapus?',
        text: "Data pegawai ini akan dihapus secara permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "{{ route('pegawai.delete', $pegawai->id_pegawai) }}";
        }
    });
});
</script>
@endsection
