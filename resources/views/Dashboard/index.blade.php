@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid py-4">
 <div class="card shadow p-4">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold text-primary mb-0">Data KGB Berdasarkan Tahun</h4>
    <form method="GET" action="{{ route('dashboard') }}" class="d-flex align-items-center">
      <label for="year" class="me-2 fw-semibold">Tahun:</label>
      <select name="year" id="year" class="form-select shadow-sm border-primary" style="width: 120px;" onchange="this.form.submit()">
        <option value="">-- Pilih Tahun --</option>
        @foreach ($availableYears as $year)
          <option value="{{ $year }}" {{ $year == $selectedYear ? 'selected' : '' }}>
            {{ $year }}
          </option>
        @endforeach
      </select>
    </form>
  </div>
</div>


   <table class="table table-bordered table-striped">
  <thead class="table-primary">
    <tr>
      <th>Bulan</th>
      <th class="text-center">Jumlah Pegawai KGB</th>
      <th class="text-center">Aksi</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($kgbData as $data)
      <tr>
        <td>{{ $data['bulan'] }}</td>
        <td class="text-center">{{ $data['jumlah_pegawai'] }}</td>
        <td class="text-center">
          <a href="{{ route('dashboard.detail', ['bulan' => $data['bulan'], 'year' => $selectedYear]) }}"
             class="btn btn-sm btn-primary">
            Detail
          </a>
        </td>
      </tr>
    @endforeach
  </tbody>
  <tfoot class="table-secondary fw-bold">
    <tr>
      <td><strong>Total Pegawai</strong></td>
      <td class="text-center"><strong>{{ $totalPegawai }}</strong></td>
      <td></td>
    </tr>
  </tfoot>
</table>

  </div>
</div>
@endsection
