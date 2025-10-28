@extends('layouts.blank')

@section('title', "Daftar Pegawai KGB Tahun $tahun Bulan $namaBulan")

@section('content')
<div class="container py-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Pegawai Kenaikan Gaji Berkala Tahun {{ $tahun }} Bulan {{ $namaBulan }}</h5>
        </div>

        <div class="card-body">
            <table class="table table-hover table-bordered align-middle">
                <thead class="table-light">
                    <tr class="text-center align-middle">
                        <th style="width: 50px;">No</th>
                        <th>Nama Pegawai</th>
                        <th style="width: 150px;">NIP</th>
                        <th style="width: 250px;">Jabatan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pegawais as $pegawai)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>
                                <a href="{{ url('/pegawai/' . $pegawai->id_sk) }}" 
                                   class="text-decoration-none text-primary fw-semibold">
                                    {{ strtoupper($pegawai->nama) }}
                                </a>
                            </td>
                            <td class="text-center">{{ $pegawai->NIP }}</td>
                            <td>{{ $pegawai->jabatan->nama_jabatan ?? '-' }}</td>
                            <td class="text-center">
                                {{ $pegawai->tanggal_surat ? date('d/m/Y', strtotime($pegawai->tanggal_surat)) : '-' }}
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
