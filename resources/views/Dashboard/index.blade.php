@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="d-flex justify-content-justify">
        <div class="container-fluid py-4">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6" style= "margin-top: -2%;">
                    <h1 style="font-weight: normal;">Dashboard KGB</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right" style="margin-top: -4%;">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>

            </div>
        </div>
    </section>
<div class="row mb-4">
    <div class="col-md-3">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $totalPegawai }}</h3>
                <p>Total Pegawai</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $totalKgb }}</h3>
                <p>Total KGB {{ $selectedYear ?? '' }}</p>
            </div>
            <div class="icon">
                <i class="fas fa-money-bill-wave"></i>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $maxKgb['jumlah_pegawai'] ?? 0 }}</h3>
                <p>KGB Terbanyak ({{ $maxKgb['bulan'] ?? '-' }})</p>
            </div>
            <div class="icon">
                <i class="fas fa-arrow-up"></i>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $minKgb['jumlah_pegawai'] ?? 0 }}</h3>
                <p>KGB Tersedikit ({{ $minKgb['bulan'] ?? '-' }})</p>
            </div>
            <div class="icon">
                <i class="fas fa-arrow-down"></i>
            </div>
        </div>
    </div>
</div>
    <div class="row mb-4">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <strong>Grafik KGB Tahun {{ $selectedYear ?? 'Semua Tahun' }}</strong>
            </div>
            <div class="card-body">
                <canvas id="kgbBarChart" height="120"></canvas>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <strong>Diagram Proporsi KGB</strong>
            </div>
            <div class="card-body">
                <canvas id="kgbPieChart"></canvas>
            </div>
        </div>
    </div>
</div>


    <!-- Main content -->
       <div class="card">
                <div class="card-header">
                    
    <section class="content">
        <div class="container-fluid">
            <!-- CARD FILTER + WELCOME -->
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                        </div>
                        <div class="col-md-6 text-md-right mt-2 mt-md-0">
                            <form method="GET" action="{{ route('dashboard') }}"
                                  class="d-inline-flex align-items-center">

                                <label class="mr-2 font-weight-normal">Kenaikan Gaji Berkala Tahun</label>

                                <select name="year" class="form-control form-control-sm"
                                        style="width: 130px;"
                                        onchange="this.form.submit()">

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

                </div>
            </div>
          </div>
                <div class="card-body">
                    <table id="kgbTable" class="table table-bordered table-hover">
                        <thead class="text-center">
                            <tr>
                                <th>Bulan</th>
                                <th>Jumlah Pegawai KGB</th>
                                @if ($selectedYear)
                        <th>Aksi</th>
                                @endif  
                            </tr>
                        </thead>

                        <tbody>
@foreach ($kgbData as $data)
    <tr>
        <td>{{ $data['bulan'] }}</td>

        <td class="text-center">
            {{ $data['jumlah_pegawai'] }}
        </td>

        @if ($selectedYear)
            <td class="text-center">
                @if ($data['jumlah_pegawai'] > 0)
                    <a href="{{ route('dashboard.detail', [
                        'bulan' => $data['bulan'],
                        'year' => $selectedYear
                    ]) }}"
                       class="btn btn-success btn-sm">
                        <i class="fas fa-eye mr-1"></i> Detail
                    </a>
                @else
                    <span class="text-muted">-</span>
                @endif
            </td>
        @endif
    </tr>
@endforeach
</tbody>

                        <tfoot class="bg-light font-weight-bold">
                    <tr>
                    <th>Total KGB</th>
             <th class="text-center">{{ $totalKgb }}</th>

                 @if ($selectedYear)
             <th></th>
            @endif
        </tr>
            </tfoot>


                    </table>

                </div>
            </div>

        </div>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            
        <script>
    const labels = @json($labels);
    const values = @json($values);

    // 🎨 WARNA KONSISTEN (URUT SESUAI BULAN)
    const chartColors = [
        '#007bff', // Januari
        '#28a745', // Februari
        '#ffc107', // Maret
        '#dc3545', // April
        '#17a2b8', // Mei
        '#6f42c1', // Juni
        '#fd7e14', // Juli
        '#20c997', // Agustus
        '#6610f2', // September
        '#e83e8c', // Oktober
        '#6c757d', // November
        '#343a40'  // Desember
    ];

    // BAR CHART
           new Chart(document.getElementById('kgbBarChart'), {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Jumlah Pegawai',
                data: values,
                backgroundColor: chartColors // ✅ beda warna tiap bulan
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1,
                        precision: 0
                    }
                }
            },
            plugins: {
                legend: { display: false }
            }
        }
    });

    // PIE CHART
       new Chart(document.getElementById('kgbPieChart'), {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [{
                data: values,
                backgroundColor: chartColors // ✅ sinkron
            }]
        }
    });
</script>

    </section>
</div>

@endsection
