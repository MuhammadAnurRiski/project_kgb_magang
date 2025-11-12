@extends('layouts.app')
@section('title', 'Pengaturan Instansi')

@section('content')
<div class="container mt-4">
  <div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
      <h5 class="mb-0">Pengaturan Instansi</h5>
    </div>
    <div class="card-body">
      @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif

      <form action="{{ route('pengaturan.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
          <div class="col-md-6 mb-3">
            <label>Nama Instansi</label>
            <input type="text" name="nama_instansi" class="form-control" 
                   value="{{ $pengaturan->nama_instansi ?? '' }}" required>
          </div>

          <div class="col-md-12 mb-3">
            <label>Alamat Instansi</label>
            <textarea name="alamat_instansi" class="form-control" rows="3">{{ $pengaturan->alamat_instansi ?? '' }}</textarea>
          </div>

          <div class="col-md-6 mb-3">
            <label>Logo Instansi</label><br>
            @if(!empty($pengaturan->logo_instansi))
              <img src="{{ asset('storage/' . $pengaturan->logo_instansi) }}" 
                   alt="Logo Instansi" class="border p-1 mb-2" width="120">
            @endif
            <input type="file" name="logo_instansi" class="form-control">
          </div>

          <div class="col-md-6 mb-3">
            <label>Tanda Tangan (QR/Scan)</label><br>
            @if(!empty($pengaturan->tanda_tangan))
              <img src="{{ asset('storage/' . $pengaturan->tanda_tangan) }}" 
                   alt="Tanda Tangan" class="border p-1 mb-2" width="120">
                   
            @endif
            <input type="file" name="tanda_tangan" class="form-control">
          </div>
        </div>

        <button type="submit" class="btn btn-success">Simpan Pengaturan</button>
      </form>
    </div>
  </div>
</div>
@endsection
