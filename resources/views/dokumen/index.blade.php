@extends('layouts.app')

@section('title', 'Manajemen Dokumen')

@section('content')
<div class="container-fluid">
    <h4 class="fw-bold text-primary mb-3">📁 Manajemen Dokumen</h4>

    {{-- Form buat folder baru --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-dark text-white">Buat Folder Baru</div>
        <div class="card-body">
            <form action="{{ route('dokumen.createFolder') }}" method="POST" class="d-flex gap-3 align-items-center">
                @csrf
                <input type="text" name="folder_name" class="form-control" placeholder="Nama folder baru..." required>
                <button class="btn btn-success">Buat Folder</button>
            </form>
        </div>
    </div>

    {{-- Daftar folder --}}
    <div class="card shadow-sm border-0">
        <div class="card-header bg-secondary text-white">Daftar Folder</div>
        <div class="card-body">
            @if($folders->count() > 0)
                <div class="row">
                    @foreach($folders as $folder)
                        <div class="col-md-3 mb-3">
                            <div class="card border-0 shadow-sm text-center p-3">
                                <a href="{{ route('dokumen.showFolder', $folder->folder_name) }}" class="text-decoration-none text-dark">
                                    <i class="bi bi-folder-fill" style="font-size: 48px; color: #f4b400;"></i>
                                    <div class="mt-2 fw-bold">{{ $folder->folder_name }}</div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-muted">Belum ada folder dibuat.</p>
            @endif
        </div>
    </div>
</div>
@endsection
