@extends('layouts.app')
@section('title', 'Cetak Surat')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4 fw-bold text-primary">Cetak Surat KGB</h1>
    <p class="text-muted">Pilih pegawai untuk menampilkan dan mencetak surat kenaikan gaji berkala (KGB).</p>

    <table class="table table-bordered table-striped align-middle shadow-sm">
        <thead class="table-primary text-center">
            <tr>
                <th style="width: 5%">No</th>
                <th style="width: 25%">Nama</th>
                <th style="width: 20%">NIP</th>
                <th style="width: 30%">Jabatan</th>
                <th style="width: 20%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pegawais as $pegawai)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="fw-semibold">{{ strtoupper($pegawai->nama) }}</td>
                    <td>{{ $pegawai->NIP }}</td>
                    <td>{{ optional($pegawai->jabatan)->nama_jabatan ?? '-' }}</td>
                    <td class="text-center">
                        <button class="btn btn-sm btn-primary px-3"
                                data-bs-toggle="modal"
                                data-bs-target="#modalCetakSurat"
                                onclick="loadCetakSurat({{ $pegawai->id_sk }})">
                            Cetak Surat
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">Belum ada data pegawai</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- =========================== MODAL CETAK SURAT =========================== -->
<div class="modal fade" id="modalCetakSurat" tabindex="-1" aria-labelledby="modalCetakSuratLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content border-0 shadow">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="modalCetakSuratLabel">Cetak Pengajuan KGB</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body" id="cetakSuratContent" style="min-height:400px;">
        <div class="text-center text-muted py-5">
          <div class="spinner-border text-primary" role="status"></div>
          <p class="mt-3">Memuat data pegawai...</p>
        </div>
      </div>

      <div class="modal-footer d-flex justify-content-end">
        <button class="btn btn-outline-secondary" id="btnPreview">
            <i class="fas fa-eye"></i> Preview
        </button>
        <button class="btn btn-success" id="btnPrint">
            <i class="fas fa-print"></i> Cetak
        </button>
        <button class="btn btn-primary" id="btnSavePDF">
            <i class="fas fa-file-pdf"></i> Simpan PDF
        </button>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
/**
 * Memuat konten modal dari data pegawai
 */
function loadCetakSurat(id) {
    $('#cetakSuratContent').html(`
        <div class="text-center text-muted py-5">
          <div class="spinner-border text-primary" role="status"></div>
          <p class="mt-3">Memuat data pegawai...</p>
        </div>
    `);

    fetch(`/surat/modal/${id}`)
        .then(res => res.text())
        .then(html => $('#cetakSuratContent').html(html))
        .catch(() => $('#cetakSuratContent').html('<p class="text-danger text-center">Gagal memuat data pegawai.</p>'));
}

/**
 * Tombol Preview Surat (tampilkan tampilan seperti PDF)
 */
$(document).on('click', '#btnPreview', function() {
    let id = $('#cetakSuratContent').data('pegawai-id');
    if (id) {
        // buka di tab baru
        window.open(`/surat/preview/${id}`, '_blank');
    } else {
        Swal.fire({
            icon: 'warning',
            title: 'Oops!',
            text: 'Data pegawai belum dimuat dengan benar.'
        });
    }
});

/**
 * Tombol Cetak Langsung dari Modal
 */
$(document).on('click', '#btnPrint', function() {
    let printContent = document.getElementById('cetakSuratContent').innerHTML;
    let printWindow = window.open('', '_blank', 'width=900,height=700');
    printWindow.document.write(`
        <html>
            <head>
                <title>Cetak Surat KGB</title>
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
                <style>
                    body { font-family: 'Times New Roman', serif; margin: 40px; }
                    table { width: 100%; border-collapse: collapse; }
                    th, td { padding: 6px; border: 1px solid #000; }
                </style>
            </head>
            <body>${printContent}</body>
        </html>
    `);
    printWindow.document.close();
    printWindow.print();
});

/**
 * Tombol Simpan PDF
 */
$(document).on('click', '#btnSavePDF', function() {
    let id = $('#cetakSuratContent').data('pegawai-id');
    if (id) window.location.href = `/surat/pdf/${id}`;
});
</script>
@endpush
