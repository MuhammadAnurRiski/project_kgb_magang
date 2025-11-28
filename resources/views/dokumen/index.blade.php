@extends('layouts.app')

@section('title', 'Manajemen Dokumen')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="text-primary fw-bold"><i class="fas fa-folder-open"></i> Manajemen Dokumen</h4>
    </div>

    {{-- Card Buat Folder Baru --}}
    <div class="card card-primary card-outline shadow-sm mb-4">
        <div class="card-header">
            <h5 class="card-title mb-0"><i class="fas fa-plus-circle"></i> Buat Folder Baru</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('dokumen.createFolder') }}" method="POST" class="row g-3">
                @csrf
                <div class="col-md-6">
                    <input type="text" name="folder_name" class="form-control form-control-sm"
                           placeholder="Masukkan nama folder..." required>
                </div>
                <div class="col-md-3">
                    <button class="btn btn-primary btn-sm w-100">
                        <i class="fas fa-folder-plus"></i> Buat Folder
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Grid Folder --}}
    <div class="card card-default shadow-sm">
        <div class="card-header">
            <h5 class="card-title mb-0"><i class="fas fa-folder"></i> Daftar Folder</h5>
        </div>

        <div class="card-body">
            <div class="explorer-grid">
                @forelse($folders as $folder)
                    <div class="explorer-item">
                        {{-- Checkbox --}}
                        <div class="folder-checkbox">
                            <input type="checkbox"
                                   name="selected_folders[]"
                                   value="{{ $folder->id }}"
                                   class="form-check-input">
                        </div>

                        {{-- Isi Folder --}}
                        <a href="{{ route('dokumen.showFolder', $folder->folder_name) }}"
                           class="explorer-link">
                            <i class="fas fa-folder folder-icon"></i>
                            <span class="explorer-name">{{ $folder->folder_name }}</span>
                        </a>
                    </div>
                @empty
                    <div class="text-center text-muted py-4">
                        <i class="fas fa-folder-open fa-2x mb-2"></i>
                        <p>Tidak ada folder.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

</div>

{{-- Custom CSS Explorer --}}
<style>
    .explorer-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        gap: 1rem;
    }

    .explorer-item {
        background: #ffffff;
        padding: 15px;
        border-radius: 8px;
        text-align: center;
        border: 1px solid #e2e5ea;
        position: relative;
        transition: 0.15s ease-in-out;
        cursor: pointer;
    }

    .explorer-item:hover {
        background: #f6f9ff;
        border-color: #c7d9ff;
        transform: translateY(-3px);
        box-shadow: 0px 3px 6px rgba(0,0,0,0.08);
    }

    .folder-icon {
        font-size: 52px;
        color: #f4c542;
        margin-bottom: 8px;
    }

    .folder-checkbox {
        position: absolute;
        top: 6px;
        left: 6px;
    }

    .explorer-name {
        display: block;
        font-size: 14px;
        font-weight: 600;
        margin-top: 6px;
        white-space: nowrap;
        text-overflow: ellipsis;
        overflow: hidden;
    }

    .explorer-link {
        text-decoration: none;
        color: #333;
        display: block;
    }
</style>

@endsection
