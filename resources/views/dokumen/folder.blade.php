@extends('layouts.app')

@section('title', "Isi Folder $folderName")

@section('content')
<div class="container-fluid">
    <h4 class="fw-bold text-primary mb-3">📂 Folder {{ $folderName }}</h4>

    {{-- Form upload file --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
            <span>Upload File ke Folder Ini</span>
        </div>
            <div class="position-absolute top-0 end-0 mt-2 me-3">
    <a href="{{ route('dokumen.index') }}" class="btn btn-light btn-sm">
        <i class="bi bi-arrow-right"></i>← Kembali
    </a>
</div>
        <div class="card-body">
            <form action="{{ route('dokumen.uploadFile') }}" method="POST" enctype="multipart/form-data" class="d-flex gap-3 align-items-center">
                @csrf
                <input type="hidden" name="folder_name" value="{{ $folderName }}">
                <input type="file" name="file" class="form-control" required>
                <button class="btn btn-success">Upload</button>
            </form>
        </div>
    </div>@extends('layouts.app')

@section('title', "Isi Folder $folderName")

@section('content')
<div class="container-fluid">
    <h4 class="fw-bold text-primary mb-3">📂 Folder {{ $folderName }}</h4>

    {{-- Form upload file --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-secondary text-white position-relative">
    <span>Upload File ke Folder Ini</span>
    <a href="{{ route('dokumen.index') }}" 
       class="btn btn-light btn-sm position-absolute top-50 end-0 translate-middle-y me-3">
        ← Kembali
    </a>
</div>

        <div class="card-body">
            <form action="{{ route('dokumen.uploadFile') }}" method="POST" enctype="multipart/form-data" class="d-flex gap-3 align-items-center">
                @csrf
                <input type="hidden" name="folder_name" value="{{ $folderName }}">
                <input type="file" name="file" class="form-control" required>
                <button class="btn btn-success">Upload</button>
            </form>
        </div>
    </div>

    {{-- Daftar file --}}
    <div class="card shadow-sm border-0">
        <div class="card-header bg-dark text-white">Isi Folder</div>
        <div class="card-body">
            @if($files->count() > 0)
                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Nama File</th>
                            <th>Tipe</th>
                            <th>Ukuran</th>
                            <th>Tanggal Upload</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($files as $file)
                            <tr>
                                <td>{{ $file->file_name }}</td>
                                <td>{{ $file->mime_type }}</td>
                                <td>{{ number_format($file->file_size / 1024, 2) }} KB</td>
                                <td>{{ $file->created_at }}</td>
                                <td>
                                    <a href="{{ route('dokumen.viewFile', $file->id) }}" target="_blank" class="btn btn-sm btn-primary">
                                        <i class="bi bi-eye"></i> Lihat
                                    </a>
                                    <form action="{{ route('dokumen.deleteFile', $file->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus file ini?')">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-muted">Belum ada file di folder ini.</p>
            @endif
        </div>
    </div>
</div>
@endsection


    {{-- Daftar file --}}
    <div class="card shadow-sm border-0">
        <div class="card-header bg-dark text-white">Isi Folder</div>
        <div class="card-body">
            @if($files->count() > 0)
                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Nama File</th>
                            <th>Tipe</th>
                            <th>Ukuran</th>
                            <th>Tanggal Upload</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($files as $file)
                            <tr>
                                <td>{{ $file->file_name }}</td>
                                <td>{{ $file->mime_type }}</td>
                                <td>{{ number_format($file->file_size / 1024, 2) }} KB</td>
                                <td>{{ $file->created_at }}</td>
                                <td>
                                    <a href="{{ route('dokumen.viewFile', $file->id) }}" target="_blank" class="btn btn-sm btn-primary">
                                        <i class="bi bi-eye"></i> Lihat
                                    </a>
                                    <form action="{{ route('dokumen.deleteFile', $file->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus file ini?')">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-muted">Belum ada file di folder ini.</p>
            @endif
        </div>
    </div>
</div>
@endsection

<style>
    
    </style>