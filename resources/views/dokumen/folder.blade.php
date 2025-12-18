@extends('layouts.app')

@section('title', "Isi Folder $folderName")

@section('content')
<div class="container-fluid">
    <h4 class="fw-bold text-primary mb-3">📂 Folder {{ $folderName }}</h4>


    {{-- Daftar file --}}
    <div class="card shadow-sm border-0">
        <div class="card-body bg-dark">
            <div class="d-flex justify-content-between align-items-center mb-2 ">
        <h5 class="mb-0 text-white">
            <i class="fas fa-file"></i> Daftar File di Folder {{ $folderName }}
        </h5>
        <a href="{{ route('dokumen.index') }}" 
           class="btn btn-primary btn-sm">
            Kembali
        </a>
        </div>
    </div>
        <div class="card-body">
            <div class="col-md-3">
            <form action="{{ route('dokumen.uploadFile') }}" method="POST" enctype="multipart/form-data" class="d-flex gap-3 align-items-center">
                @csrf
                <input type="hidden" name="folder_name" value="{{ $folderName }}">
                <input type="file" name="file" class="form-control" required>
                <button class="btn btn-success">Upload</button>
            </form>
        </div>
        </div>
        <div class="card-body">
            @if($files->count() > 0)
                <table class="table table-bordered align-middle">
                    <thead class="">
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