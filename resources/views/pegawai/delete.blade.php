@extends ('laypouts.app')
@section('title', 'Hapus Pegawai')
@section('content')
<div class="container-fluid">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-danger text-white">
            <h5 class="mb-0"><i class="fas fa-user-minus"></i> Hapus Data Pegawai</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('pegawai.destroy', $pegawai->id_pegawai) }}" method="POST">
                @csrf
                @method('DELETE')
                <p>Apakah Anda yakin ingin menghapus data pegawai <strong>{{ $pegawai->nama_pegawai }}</strong>?</p>
                <div class="d-flex justify-content-between">
                    <a href="{{ route('pegawai.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Batal
                    </a>
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash-alt"></i> Hapus
                    </button>
                </div>
            </form>
        </div>
    </div>