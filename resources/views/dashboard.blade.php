@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid px-4 py-3">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-semibold text-dark">Dashboard</h3>
        <div class="d-flex align-items-center">
            <label class="me-2 fw-semibold text-secondary">Kenaikan Gaji Berkala Tahun</label>
            <select class="form-select form-select-sm w-auto">
                <option>2025</option>
                <option>2024</option>
                <option>2023</option>
            </select>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <table class="table table-bordered align-middle mb-0">
                <thead class="table-light">
                    <tr class="text-center">
                        <th style="width: 60px;">No.</th>
                        <th>Bulan</th>
                        <th>Jumlah Pegawai KGB</th>
                        <th>Jumlah Surat KGB telah Tercetak</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $months = [
                            'Januari','Februari','Maret','April','Mei','Juni',
                            'Juli','Agustus','September','Oktober','November','Desember'
                        ];
                    @endphp

                    @foreach ($months as $i => $bulan)
                        <tr>
                            <td class="text-center">{{ $i + 1 }}</td>
                            <td>
                                <a href="#" class="text-primary text-decoration-none fw-semibold">
                                    {{ $bulan }}
                                </a>
                            </td>
                            <td class="text-center">10</td>
                            <td class="text-center">{{ ($i < 10) ? '10' : ($i == 10 ? '3' : '0') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    body {
        background-color: #f8f9fc !important;
    }

    .table thead th {
        background-color: #f1f3f6;
        color: #333;
        font-weight: 600;
        border-bottom: 2px solid #dee2e6;
    }

    .table tbody td {
        vertical-align: middle;
        color: #333;
    }

    .table a {
        transition: 0.2s ease;
    }

    .table a:hover {
        text-decoration: underline;
        color: #0056b3;
    }

    .card {
        border-radius: 8px;
    }

    .form-select-sm {
        font-size: 0.9rem;
        padding: 4px 8px;
    }
</style>
@endpush
