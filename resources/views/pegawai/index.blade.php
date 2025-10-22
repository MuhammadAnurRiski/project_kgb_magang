@extends('layouts.app')

@section('title', 'Profil Pegawai')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3><i class="fas fa-users"></i> Profil Pegawai</h3>
        <div>
            <a href="{{ route('pegawai.create') }}" class="btn btn-success">
                <i class="fas fa-plus"></i> Tambah Pegawai
            </a>
        </div>
    </div>

    <table id="pegawaiTable" class="table table-hover table-bordered align-middle">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NIP</th>
                <th>Jabatan</th>
                <th>TMT Gaji Baru</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pegawais as $pegawai)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <a href="{{ route('pegawai.show', $pegawai->id_sk) }}" class="text-decoration-none fw-semibold text-primary">
                            {{ strtoupper($pegawai->nama) }}
                        </a>
                    </td>
                    <td>{{ $pegawai->NIP }}</td>
                    <td>{{ optional($pegawai->jabatan)->nama_jabatan ?? '-' }}</td>
                    <td>{{ $pegawai->tmt_gaji_baru ? date('d/m/Y', strtotime($pegawai->tmt_gaji_baru)) : '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">Tidak ada data pegawai</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

@if (session('success'))
<script>
Swal.fire({
    icon: 'success',
    title: 'Berhasil!',
    text: '{{ session('success') }}',
    showConfirmButton: false,
    timer: 2000
});
</script>
@endif
