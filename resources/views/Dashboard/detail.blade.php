@extends('layouts.app')

@section('title', 'Detail KGB Bulan ' . $bulan)

@section('content')
<div class="container-fluid py-4">
  <div class="card shadow p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h4 class="mb-2" style="font-weight: normal;">
        Daftar Pegawai KGB Bulan {{ $bulan }} {{ $tahun }}
      </h4>
      <div class="text-center">
      <a href="{{ route('dashboard', ['year' => $tahun]) }}" class="btn btn-info mr-3">
      <i class="fas fa-chevron-left"></i> 
      </a>
      </div>
    </div>

    <div class="card-body">
                    <table id="kgbTable" class="table table-bordered table-hover">
                        <thead class="text-center">
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
            <td style="text-align: center;">{{ $index + 1 }}</td>
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
