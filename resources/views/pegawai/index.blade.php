@extends('layouts.app')
@section('title', 'Profil Pegawai')

@section('content')
<div class="container-fluid">
  <!-- Header dan tombol tambah -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">
      <i class="fas fa-users me-2"></i> Profil Pegawai
    </h4>
  </div>
<!-- 🔍 Form Search dan Tambah pegawai AdminLTE 3 -->
  <div class="card shadow-sm border-0">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center mb-1">
    <a href="{{ route('pegawai.create') }}" class="btn btn-success">
      <i class="fas fa-user-plus me-1"></i> Tambah Pegawai
    </a>
<form method="GET" action="{{ route('pegawai.index') }}">
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
                <a href="{{ route('pegawai.index') }}" class="btn btn-default">
                    <i class="fas fa-times"></i>
                </a>
                @endif
            </div>

        </div>
    </div>
</form>
</div>
</div>


  <!-- Tabel Data Pegawai -->
 <div class="card shadow-sm border-0">
    <div class="card-body">
      <table id="kgbTable" class="table table-bordered table-hover">
        <thead class="text-center">
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>NIP</th>
            <th>Jabatan</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($pegawai as $index => $p)
          <tr>
            <td class="text-center">{{ $pegawai->firstItem() + $loop->index }}</td>
            <td>
              <a href="{{ route('pegawai.show', $p->id_pegawai) }}"
                 class="text-decoration-none text-primary">
                <u>{{($p->nama_pegawai) }}</u>
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


@endsection
