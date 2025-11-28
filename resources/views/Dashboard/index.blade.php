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
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($kgbData as $data)
                                <tr>
                                    <td>{{ $data['bulan'] }}</td>

                                    <td class="text-center">
                                        {{ $data['jumlah_pegawai'] }}
                                    </td>

                                    <td class="text-center">
                                        <a href="{{ route('dashboard.detail', ['bulan' => $data['bulan'], 'year' => $selectedYear]) }}"
                                           class="btn btn-success btn-sm">
                                            <i class="fas fa-eye mr-1"></i> Detail
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                        <tfoot class="bg-light font-weight-bold">
                            <tr>
                                <th>Total Pegawai</th>
                                <th class="text-center">{{ $totalPegawai }}</th>
                                <th></th>
                            </tr>
                        </tfoot>

                    </table>

                </div>
            </div>

        </div>

    </section>
</div>

@endsection
