@extends('layouts.app')

@section('title', 'Manajemen Dokumen')

@section('content')
<div class="container">
    <form action="{{ route('dokumen.deleteMultiple') }}" method="POST" id="deleteSelectedForm">
        @csrf
        @method('DELETE')

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold mb-0">📁 Manajemen Dokumen</h4>
            <button type="submit" class="btn btn-danger btn-sm"
                    onclick="return confirm('Yakin ingin menghapus folder yang dipilih?')">
                <i class="bi bi-trash"></i> Hapus Terpilih
            </button>
        </div>

        {{-- Notifikasi --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- Grid Folder --}}
        <div class="explorer-grid">
            @forelse($folders as $folder)
                <div class="explorer-item position-relative">
                    {{-- Checkbox --}}
                    <input type="checkbox" name="selected_folders[]" value="{{ $folder->id }}" 
                           class="form-check-input position-absolute top-0 start-0 m-2">

                    {{-- Folder --}}
                    <a href="{{ route('dokumen.showFolder', $folder->folder_name) }}" 
                       class="explorer-link text-decoration-none text-dark">
                        <i class="bi bi-folder-fill explorer-icon"></i>
                        <span class="explorer-name text-truncate">{{ $folder->folder_name }}</span>
                    </a>
                </div>
            @empty
                <div class="text-center text-muted mt-4">
                    <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                    <p>Belum ada folder yang dibuat.</p>
                </div>
            @endforelse
        </div>
    </form>
</div>

{{-- CSS: Tampilan seperti Windows Explorer --}}
<style>
    .explorer-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
        gap: 1rem;
        padding: 10px;
        background-color: #f8f9fa;
        border-radius: 10px;
    }

    .explorer-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        padding: 12px;
        border-radius: 8px;
        transition: all 0.2s ease;
        background-color: #ffffff;
        border: 1px solid transparent;
        position: relative;
    }

    .explorer-item:hover {
        background-color: #e7f1ff;
        border: 1px solid #c2dbff;
        box-shadow: 0 0 6px rgba(0, 0, 0, 0.08);
        transform: scale(1.02);
    }

    .explorer-icon {
        font-size: 64px;
        color: #f4b400;
        margin-bottom: 8px;
    }

    .explorer-name {
        font-weight: 500;
        font-size: 14px;
        max-width: 120px;
        white-space: nowrap;
    }

    /* Checkbox agar rapi dan tidak mengganggu klik */
    .form-check-input {
        z-index: 10;
        transform: scale(1.2);
    }

    /* Saat folder dipilih */
    .form-check-input:checked ~ .explorer-link {
        background-color: #dbeafe;
        border-radius: 6px;
    }

    @media (max-width: 576px) {
        .explorer-icon {
            font-size: 48px;
        }
    }
</style>
@endsection
