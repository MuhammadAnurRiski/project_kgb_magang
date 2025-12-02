@extends('layouts.app')

@section('title', 'Cetak Surat')

@section('content')
<div class="container-fluid mt-4">
  <div class="card card-success shadow-sm border-0">
    <div class="card-header">
      <h5 class="mb-0"><i class="fas fa-envelope-open-text me-2"></i>Daftar Pegawai</h5>
    </div>
    <div class="card-body">
     <form method="GET" action="{{ route('surat.index') }}">
    <div class="card-tools">
        <div class="input-group" style="width: 300px;">

            <input type="text"
                   name="search"
                   class="form-control float-right"
                   placeholder="Search"
                   value="{{ request('search') }}">

            <div class="input-group-append">
                <button type="submit" class="btn btn-default" style="background-color: #0d47a1;">
                    <i class="fas fa-search text-white"></i>
                </button>

                @if(request('search'))
                <a href="{{ route('surat.index') }}" class="btn btn-default">
                    <i class="fas fa-times"></i>
                </a>
                @endif
            </div>

        </div>
    </div>
</form>
    </div>

     <div class="card shadow-sm border-0">
    <div class="card-body">
      <table id="kgbTable" class="table table-bordered table-hover">
        <thead class="text-center">
            <tr>
              <th>No</th>
              <th>Nama Pegawai</th>
              <th>NIP</th>
              <th>Jabatan</th>
              <th>Aksi</th>
            </tr>
          </thead>

          <tbody>
            @forelse ($pegawai as $index => $p)
              <tr>
                <td class="text-center">{{ $pegawai->firstItem() + $loop->index }}</td>
                <td>{{ $p->nama_pegawai }}</td>
                <td>{{ $p->nip }}</td>
                <td>{{ $p->jabatan ?? '-' }}</td>
                <td>
                  <div class="d-flex justify-content-center gap-2">

                    {{-- Tombol Edit Surat --}}
                    <a href="{{ route('surat.edit', $p->id_pegawai) }}" class="btn btn-sm btn-warning text-white">
                      <i class="fas fa-edit me-1"></i> <strong>Edit & preview</strong>
                    </a>

                    {{-- Tombol Cetak PDF --}}
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
      <div class="row mt-5 px-3">
    <!-- INFO -->
    <div class="col-sm-12 col-md-5">
        <div class="dataTables_info">
            Showing {{ $pegawai->firstItem() }} to {{ $pegawai->lastItem() }} of {{ $pegawai->total() }} entries
        </div>
    </div>

    <!-- PAGINATION -->
    <div class="col-sm-12 col-md-7">
        <div class="dataTables_paginate paging_simple_numbers d-flex justify-content-end">
            {{ $pegawai->links('pagination::adminlte') }}
        </div>
    </div>
</div>
</div>
  </div>
</div>

@endsection
