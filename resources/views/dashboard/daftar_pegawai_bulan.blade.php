@extends('layouts.app')

@section('title', "Daftar Pegawai KGB Tahun $tahun Bulan $namaBulan")

@section('content')
<div class="container py-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Pegawai Kenaikan Gaji Berkala Tahun {{ $tahun }} Bulan {{ $namaBulan }}</h5>
            <a href="{{ route('dashboard.index') }}" class="btn btn-light btn-sm">
                <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
            </a>
        </div>

        <div class="card-body">
            <table class="table table-hover table-bordered align-middle">
                <thead class="table-light">
                    <tr class="text-center">
                        <th>No</th>
                        <th>Nama Pegawai</th>
                        <th>NIP</th>
                        <th>Jabatan</th>
                        <th>Tanggal SK</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pegawais as $pegawai)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>
                                <a href="{{ route('pegawai.show', $pegawai->id_sk) }}" class="text-decoration-none text-primary fw-semibold">
                                    {{ strtoupper($pegawai->nama) }}
                                </a>
                            </td>
                            <td>{{ $pegawai->NIP }}</td>
                            <td>{{ $pegawai->jabatan->nama_jabatan ?? '-' }}</td>
                            <td class="text-center">
                                {{ $pegawai->tanggal_surat ? date('d/m/Y', strtotime($pegawai->tanggal_surat)) : '-' }}
                            </td>
                            <td class="text-center fst-italic">
                                @if($pegawai->tanggal_surat)
                                    <span class="text-success">Telah dicetak</span>
                                @else
                                    <span class="text-muted">Belum dicetak</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                Tidak ada pegawai KGB pada bulan ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
