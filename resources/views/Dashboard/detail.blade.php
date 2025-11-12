@extends('layouts.app')

@section('title', 'Detail KGB Bulan ' . $bulan)

@section('content')
<div class="container-fluid py-4">
  <div class="card shadow p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h4 class="fw-bold text-primary mb-0">
        Daftar Pegawai KGB Bulan {{ $bulan }} {{ $tahun }}
      </h4>
      <a href="{{ route('dashboard', ['year' => $tahun]) }}" class="btn btn-secondary btn-sm">
        ← Kembali
      </a>
    </div>

    <table class="table table-bordered table-striped">
      <thead class="table-primary">
        <tr>
          <th>No</th>
          <th>Nama Pegawai</th>
          <th>NIP</th>
          <th>Jabatan</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($pegawaiList as $index => $item)
          <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $item->nama_pegawai }}</td>
            <td>{{ $item->nip }}</td>
            <td>{{ $item->jabatan }}</td>
          </tr>
        @empty
          <tr>
            <td colspan="4" class="text-center">Tidak ada data pegawai untuk bulan ini</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
