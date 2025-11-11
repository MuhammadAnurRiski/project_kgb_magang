<!-- menampilkan daftar kgb dalam tabel seperti di dashboard, namun dengan tambahan kolom aksi untuk melihat detail pegawai yang kgb pada bulan tersebut-->
@extends('layouts.app')
@section('title', 'Data KGB')
@section('content')
<div class="container-fluid">  
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold text-primary">Daftar Kenaikan Gaji Berkala (KGB)</h4>
    </div>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    <table class="table table-bordered table-striped">
        <thead class="table-primary">
        <tr>
            <th>No</th>
            <th>Bulan</th>
            <th>Jumlah Pegawai KGB</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        @foreach($kgbData as $index => $data)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $data['bulan'] }}</td>
            <td>{{ $data['jumlah_pegawai'] }}</td>
            <td>
            <a href="{{ route('kgb.detail', ['bulan' => $data['bulan']]) }}" class="btn btn-info btn-sm">Lihat Detail</a>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
