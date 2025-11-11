@extends('layouts.app')

@section('title', 'Cetak Surat')

@section('content')
<div class="container-fluid mt-4">
  <div class="card shadow-sm border-0">
    <div class="card-header bg-primary text-white">
      <h5 class="mb-0"><i class="fas fa-envelope-open-text me-2"></i>Daftar Pegawai - Cetak Surat</h5>
    </div>

    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
          <thead class="table-primary text-center">
            <tr>
              <th style="width: 5%">No</th>
              <th style="width: 20%">Nama Pegawai</th>
              <th style="width: 15%">NIP</th>
              <th style="width: 20%">Jabatan</th>
              <th style="width: 20%">Aksi</th>
            </tr>
          </thead>

          <tbody>
            @forelse ($pegawai as $index => $p)
              <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $p->nama_pegawai }}</td>
                <td>{{ $p->nip }}</td>
                <td>{{ $p->jabatan ?? '-' }}</td>
                <td>
                  <div class="d-flex justify-content-center gap-2">

                    {{-- Tombol Edit Surat --}}
                    <a href="{{ route('surat.edit', $p->id_pegawai) }}" class="btn btn-sm btn-warning text-white">
                      <i class="fas fa-edit me-1"></i> Edit
                    </a>

                    {{-- Tombol Cetak PDF --}}
                    <a href="{{ route('surat.cetak', $p->id_pegawai) }}" class="btn btn-sm btn-success">
                      <i class="fas fa-print me-1"></i> Cetak
                    </a>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="6" class="text-center text-muted py-3">
                  <i class="fas fa-info-circle me-1"></i>Belum ada data pegawai
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<div class="d-flex justify-content-center mt-3">
    {{ $pegawai->links('pagination::bootstrap-5') }}
</div>
<style>
.pagination {
    justify-content: center;
}
</style>
@endsection
