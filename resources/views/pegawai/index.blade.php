@extends('layouts.app')
@section('title', 'Profil Pegawai')

@section('content')
<div class="container-fluid">
  <!-- Header dan tombol tambah -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold text-primary mb-0">
      <i class="fas fa-users me-2"></i> Profil Pegawai
    </h4>
    <a href="{{ route('pegawai.create') }}" class="btn btn-success">
      <i class="fas fa-user-plus me-1"></i> Tambah Pegawai
    </a>
  </div>
  
  <style>
.input-group-text i {
  font-size: 1rem;
}
.input-group .form-control:focus {
  box-shadow: none;
  border-color: #0d6efd;
}
</style>

<!-- 🔍 Form Search -->
<form method="GET" action="{{ route('pegawai.index') }}" class="mb-4">
  <div class="row justify-content-end">
    <div class="col-md-5">
      <div class="input-group shadow-sm">
        <span class="input-group-text bg-primary text-white">
          <i class="fas fa-search"></i>
        </span>
        <input type="text" name="search" class="form-control border-primary"
               placeholder="Cari nama, NIP, atau jabatan..."
               value="{{ request('search') }}">
        <button type="submit" class="btn btn-primary px-4">
          Cari
        </button>
        @if(request('search'))
        <a href="{{ route('pegawai.index') }}" class="btn btn-outline-secondary">
          <i class="fas fa-times"></i>
        </a>
        @endif
      </div>
    </div>
  </div>
</form>
    @if(request('search'))
      <a href="{{ route('pegawai.index') }}" class="btn btn-outline-secondary">
        <i class="fas fa-times"></i> Reset
      </a>
    @endif
  </div>
</form>

  <!-- Tabel Data Pegawai -->
  <div class="card shadow-sm border-0">
    <div class="card-body">
      <table class="table table-hover table-bordered align-middle mb-0">
        <thead class="table-light text-center">
          <tr>
            <th style="width: 5%">No</th>
            <th style="width: 30%">Nama</th>
            <th style="width: 20%">NIP</th>
            <th style="width: 30%">Jabatan</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($pegawai as $index => $p)
          <tr>
            <td class="text-center">{{ $index + 1 }}</td>
            <td>
              <a href="{{ route('pegawai.show', $p->id_pegawai) }}"
                 class="fw-semibold text-decoration-none text-primary">
                {{ strtoupper($p->nama_pegawai) }}
              </a>
            </td>
            <td>{{ $p->nip }}</td>
            <td>{{ $p->jabatan }}</td>
          </tr>
          @empty
          <tr>
            <td colspan="4" class="text-center text-muted py-4">
              <i class="fas fa-info-circle me-1"></i> Belum ada data pegawai.
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
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
<!-- Modal umum -->
<div class="modal fade" id="modalPegawai" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-body p-0" id="modalPegawaiContent">
        <div class="p-4 text-center text-muted">Memuat...</div>
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script>
function loadDetail(url) {
  $('#modalPegawai').modal('show');
  $('#modalPegawaiContent').load(url, function(response, status) {
    if (status === "error") {
      $('#modalPegawaiContent').html('<div class="p-4 text-center text-danger">Terjadi kesalahan saat memuat data</div>');
    }
  });
}

function openForm(url) {
  $('#modalPegawai').modal('show');
  $('#modalPegawaiContent').load(url, function(response, status) {
    if (status === "error") {
      $('#modalPegawaiContent').html('<div class="p-4 text-center text-danger">Terjadi kesalahan saat memuat form</div>');
    }
  });
}

$('#modalPegawai').on('hidden.bs.modal', function() {
  $('#modalPegawaiContent').html('<div class="p-4 text-center text-muted">Memuat...</div>');
});
</script>

@if(session('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="icon fas fa-check-circle"></i>
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

@if(session('error'))
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <i class="icon fas fa-exclamation-triangle"></i>
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

@endpush
@endsection
