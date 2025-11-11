@extends('layouts.app')

@section('title', 'Edit Profil Pegawai')

@section('content')
<div class="container-fluid">
    <h4 class="fw-bold text-primary mb-3">Edit Profil Pegawai</h4>

    <form action="{{ route('pegawai.update', $pegawai->id_pegawai) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Nama Pegawai</label>
                <input type="text" name="nama_pegawai" class="form-control" value="{{ old('nama_pegawai', $pegawai->nama_pegawai) }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label>NIP</label>
                <input type="text" name="nip" class="form-control" value="{{ old('nip', $pegawai->nip) }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label>Jabatan</label>
                <input type="text" name="jabatan" class="form-control" value="{{ old('jabatan', $pegawai->jabatan) }}" required>
            </div>
           <div class="col-md-6 mb-3">
    <label class="fw-semibold text-secondary">Pangkat / Golongan</label>
    <input list="pangkatList" name="pangkat_golongan" class="form-control"
        value="{{ old('pangkat_golongan', $pegawai->pangkat_golongan) }}"
        placeholder="Ketik atau pilih pangkat / golongan" required>

    <datalist id="pangkatList">
        @foreach ($pangkat_golongan as $pg)
            <option value="{{ $pg->nama_pangkat_golongan }}"></option>
        @endforeach
    </datalist>
</div>
<div class="col-md-6 mb-3">
                <label>TMT Pangkat</label>
                <input type="date" name="tmt_pangkat" class="form-control" value="{{ old('tmt_pangkat', $pegawai->tmt_pangkat) }}" required>
            </div>
        </div>

        <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('pegawai.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
