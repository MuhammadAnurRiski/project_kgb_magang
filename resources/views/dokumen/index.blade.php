@extends('layouts.app') {{-- atau layouts.blank jika kamu pakai itu --}}
@section('title', 'Manajemen Dokumen')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-secondary text-white">
            <h5 class="mb-0">Manajemen Dokumen KGB</h5>
        </div>
        <div class="card-body">
            <p>Halaman ini digunakan untuk mengelola dokumen KGB seperti yang ada di tampilan folder tahun (KGB 2024, KGB 2025).</p>
        </div>
    </div>
</div>
@endsection
