@extends('layouts.app')

@section('title', 'Manajemen Dokumen')

@section('content')
<div class="container-fluid">

    {{-- ========================= --}}
    {{--   HEADER & NOTIFIKASI     --}}
    {{-- ========================= --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold">
            <i class="fas fa-folder-open"></i> Manajemen Dokumen
        </h4>
    </div>

  @if(session('success'))
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h5><i class="icon fas fa-check"></i> Berhasil!</h5>
    {{ session('success') }}
</div>
@endif


@if(session('error'))
<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h5><i class="icon fas fa-exclamation-triangle"></i> Gagal!</h5>
    {{ session('error') }}
</div>
@endif



    {{-- ========================= --}}
    {{--     FORM BUAT FOLDER      --}}
    {{-- ========================= --}}
    <div class="card shadow-sm border-primary mb-4">
        <div class="card-header text-black">
            <h5 class="mb-0"><i class="fas fa-plus-circle"></i> Buat Folder Baru</h5>
        </div>

        <div class="card-body compact-body">
            <form action="{{ route('dokumen.createFolder') }}" method="POST" class="row g-3">
                @csrf
                <div class="col-md-2">
                    <input type="text" name="folder_name" class="form-control"
                           placeholder="Masukkan nama folder..." required>
                </div>
                <div class="col-md-3">
                    <button class="btn btn-success">
                        <i class="fas fa-folder-plus"></i> Buat Folder
                    </button>
                </div>
            </form>
        </div>
    </div>


    {{-- ========================= --}}
    {{--  DAFTAR FOLDER + DELETE   --}}
    {{-- ========================= --}}
<div class="card shadow-sm border-0">

    <div class="card-header bg-secondary text-white">
        <h5 class="mb-0">
            <i class="fas fa-folder"></i> Daftar Folder
        </h5>
    </div>


    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center mb-1">
    <form method="GET" action="{{ route('dokumen.index') }}">
        <div class="input-group input-group-sm col-md-30" style="width: 190%">
            <input type="text"
                   name="search"
                   class="form-control"
                   placeholder="Cari folder..."
                   value="{{ request('search') }}">

            <div class="input-group-append">
                <button class="btn btn-primary">
                    <i class="fas fa-search"></i>
                </button>

                @if(request('search'))
                <a href="{{ route('dokumen.index') }}" class="btn btn-light">
                    <i class="fas fa-times"></i>
                </a>
                @endif
            </div>
        </div>
    </form>

        <form action="{{ route('dokumen.deleteMultiple') }}" method="POST" id="deleteForm">
        @csrf @method('DELETE')
            {{-- Tombol awal --}}
            <button type="button" id="toggleDelete" class="btn btn-danger btn-sm">
                <i class="fas fa-trash"></i> Hapus
            </button>
            

            {{-- Tombol konfirmasi hapus --}}
            <button type="button" id="confirmDelete" class="btn btn-danger btn-sm d-none">
                <i class="fas fa-check"></i> Hapus Terpilih
            </button>

            {{-- Tombol batal --}}
            <button type="button" id="cancelDelete" class="btn btn-secondary btn-sm d-none">
                <i class="fas fa-times"></i> Batalkan
            </button>

        </div>
    </div>
    <div class="card-body">
                <div class="explorer-grid">
                    @forelse($folders as $folder)
                        <div class="explorer-item">

                            {{-- Checkbox --}}
                            <div class="folder-checkbox d-none">
                                <input type="checkbox" class="form-check-input"
                                       name="selected_folders[]" value="{{ $folder->id }}">
                            </div>

                            {{-- Folder --}}
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

    </form>
</div>
</div>
</div>


{{-- ========================= --}}
{{--           CSS            --}}
{{-- ========================= --}}
<style>
  
    .explorer-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        gap: 1rem;
    }

    .explorer-item {
        background: #fff;
        padding: 20px 10px;
        border-radius: 10px;
        text-align: center;
        border: 1px solid #e3e6ee;
        position: relative;
        transition: 0.2s;
        cursor: pointer;
    }

    .explorer-item:hover {
        background: #eef3ff;
        border-color: #b8c8ff;
        transform: translateY(-3px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.08);
    }

    .folder-icon {
        font-size: 48px;
        color: #f4c542;
    }

    .explorer-name {
        display: block;
        margin-top: 8px;
        font-size: 15px;
        font-weight: 600;
        text-transform: capitalize;
    }

    .folder-checkbox {
        position: absolute;
        top: 8px;
        left: 8px;
    }
</style>


{{-- ========================= --}}
{{--           JS             --}}
{{-- ========================= --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    const toggleDelete = document.getElementById('toggleDelete');
    const confirmDelete = document.getElementById('confirmDelete');
    const cancelDelete = document.getElementById('cancelDelete');
    const checkboxes = document.querySelectorAll('.folder-checkbox');
    const formDelete = document.getElementById('deleteForm');

    // Mode delete
    toggleDelete.addEventListener('click', () => {
        checkboxes.forEach(c => c.classList.remove('d-none'));
        toggleDelete.classList.add('d-none');
        confirmDelete.classList.remove('d-none');
        cancelDelete.classList.remove('d-none');
    });

    cancelDelete.addEventListener('click', () => {
        checkboxes.forEach(c => {
            c.classList.add('d-none');
            c.querySelector('input').checked = false;
        });
        toggleDelete.classList.remove('d-none');
        confirmDelete.classList.add('d-none');
        cancelDelete.classList.add('d-none');
    });

    // SWEETALERT KONFIRMASI DELETE
    confirmDelete.addEventListener('click', function () {

        // Cek apakah ada checkbox yang dicentang
        const selected = document.querySelectorAll('input[name="selected_folders[]"]:checked');
        if (selected.length === 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Tidak ada folder yang dipilih',
                text: 'Pilih minimal satu folder untuk dihapus.',
                timer: 2000
            });
            return;
        }

        Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: "Folder yang dipilih akan dihapus permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                formDelete.submit();
            }
        });
    });
</script>

<script>
    // Alert otomatis hilang setelah 3 detik
    setTimeout(function() {
        $('.alert').fadeOut('slow');
    }, 3000);
</script>

@endsection
