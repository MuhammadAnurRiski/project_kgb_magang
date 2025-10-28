@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        {{-- 🔹 Judul tanpa icon --}}
        <h3 class="fw-bold">Dashboard</h3>

        {{-- 🔽 Dropdown Tahun --}}
        <div>
            <label class="me-2 fw-semibold">Kenaikan Gaji Berkala Tahun</label>
            <div class="btn-group">
                <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    {{ $tahun ?? date('Y') }}
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    @for ($year = 2023; $year <= 2040; $year++)
                        <li>
                            <a class="dropdown-item {{ $tahun == $year ? 'active fw-bold' : '' }}"
                               href="{{ route('dashboard', ['tahun' => $year]) }}">
                               {{ $year }}
                            </a>
                        </li>
                    @endfor
                </ul>
            </div>
        </div>
    </div>

    {{-- 🔹 Tabel Data --}}
    <table class="table table-hover table-bordered align-middle">
        <thead class="table-light">
            <tr>
                <th style="width: 5%;">No</th>
                <th>Bulan</th>
                <th class="text-end">Jumlah Pegawai KGB</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalPegawai = 0;
            @endphp

            @foreach ($bulanList as $index => $bulan)
                @php
                    $jumlah = $data[$bulan] ?? 0;
                    $totalPegawai += $jumlah;
                @endphp
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $bulan }}</td>
                    <td class="text-end">{{ $jumlah }}</td>
                </tr>
            @endforeach
        </tbody>

        {{-- 🔸 Baris Total dengan warna biru --}}
        <tfoot style="background-color: #1e1b4b; color: white; font-weight: bold;">
            <tr>
                <td colspan="2" class="text-center">Total</td>
                <td class="text-end">{{ $totalPegawai }}</td>
            </tr>
        </tfoot>
    </table>
</div>
@endsection
