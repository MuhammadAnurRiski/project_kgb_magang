@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid py-3">
    <!-- 🟢 Header Dashboard -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold text-secondary">Dashboard</h5>
        <div class="d-flex align-items-center">
            <span class="me-2 text-muted">Kenaikan Gaji Berkala Tahun</span>
            <select id="tahunSelect" class="form-select form-select-sm w-auto">
                @for ($t = date('Y'); $t >= 2020; $t--)
                    <option value="{{ $t }}" {{ request('tahun', date('Y')) == $t ? 'selected' : '' }}>
                        {{ $t }}
                    </option>
                @endfor
            </select>
        </div>
    </div>

    <!-- 🟢 Tabel Statistik KGB -->
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <table class="table table-hover table-bordered mb-0 align-middle">
                <thead class="table-light text-center">
                    <tr>
                        <th style="width: 60px;">No</th>
                        <th>Bulan</th>
                        <th style="width: 250px;">Jumlah Pegawai KGB</th>
                        <th style="width: 250px;">Jumlah Surat KGB telah Tercetak</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bulanList as $index => $namaBulan)
                        @php $bulan = $index + 1; @endphp
                        <tr>
                            <td class="text-center">{{ $bulan }}</td>
                            <td>
                                <!-- 🔹 Link langsung menuju halaman daftar pegawai bulan -->
                                <a href="{{ url('/dashboard/pegawai/' . request('tahun', date('Y')) . '/' . $bulan) }}"
                                   class="fw-semibold text-primary text-decoration-none bulan-link"
                                   data-bulan="{{ $bulan }}"
                                   data-nama="{{ $namaBulan }}">
                                   {{ $namaBulan }}
                                </a>
                            </td>
                            <td class="text-center">{{ $jumlahPegawai[$index] ?? 0 }}</td>
                            <td class="text-center">{{ $jumlahSurat[$index] ?? 0 }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // 🔹 Ganti tahun => reload halaman dengan parameter tahun
    $('#tahunSelect').on('change', function() {
        const tahun = $(this).val();
        window.location.href = `/dashboard?tahun=${tahun}`;
    });

    // 🔹 Klik bulan => langsung redirect ke halaman detail (tanpa preventDefault)
    $(document).on('click', '.bulan-link', function(e) {
        const tahun = $('#tahunSelect').val();
        const bulan = $(this).data('bulan');
        const url = `/dashboard/pegawai/${tahun}/${bulan}`;
        window.location.href = url;
    });
});
</script>
@endpush
