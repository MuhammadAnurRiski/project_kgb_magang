@extends('layouts.app')

@section('title', 'Tambah Pegawai')

@section('content')
<div class="container-fluid py-4">
  <div class="card shadow p-4">
    <h4 class="fw-bold mb-4 text-primary border-bottom pb-2">Tambah Pegawai</h4>

    <form action="{{ route('pegawai.store') }}" method="POST">
      @csrf

      {{-- ================== DATA UTAMA PEGAWAI ================== --}}
      <div class="row g-4">
        {{-- Nama dan NIP --}}
        <div class="col-md-6">
          <label class="fw-bold">Nama Pegawai</label>
          <input type="text" name="nama_pegawai" class="form-control" placeholder="Masukkan nama pegawai..." required>
        </div>

        <div class="col-md-6">
          <label class="fw-bold">NIP</label>
          <input type="text" name="nip" class="form-control" placeholder="Masukkan NIP..." required>
        </div>

        {{-- Jabatan dan Pangkat --}}
        <div class="col-md-6">
          <label class="fw-bold">Jabatan</label>
          <input list="jabatanList" name="jabatan" class="form-control" placeholder="Ketik atau pilih jabatan">
          <datalist id="jabatanList">
            @foreach ($jabatan as $j)
              <option value="{{ $j->nama_jabatan }}">
            @endforeach
          </datalist>
        </div>

        <div class="col-md-6">
          <label class="fw-bold">Pangkat / Golongan</label>
          <input list="pangkatList" name="pangkat_golongan" class="form-control" placeholder="Ketik atau pilih pangkat/golongan">
          <datalist id="pangkatList">
            @foreach ($pangkat_golongan as $pg)
              <option value="{{ $pg->nama_pangkat_golongan }}">
            @endforeach
          </datalist>
        </div>

        {{-- TMT Pangkat --}}
        <div class="col-md-6">
          <label class="fw-bold">TMT Pangkat</label>
          <input type="date" name="tmt_pangkat" class="form-control">
        </div>
      </div>

      {{-- ================== PEMBATAS KE BAGIAN DATA KGB ================== --}}
      <hr class="my-5">
      <h5 class="fw-bold text-success mb-4">Data KGB</h5>

      <div class="row g-4">
        {{-- Gaji Pokok Lama --}}
        <div class="col-md-6">
          <label class="fw-bold">Gaji Pokok Lama</label>
          <input list="gajiList" name="nominal_gaji" class="form-control" placeholder="Ketik atau pilih nominal gaji">
          <datalist id="gajiList">
            @foreach ($gajiOptions as $opt)
              <option value="Rp {{ number_format($opt, 0, ',', '.') }}"></option>
            @endforeach
          </datalist>
        </div>

        {{-- Pejabat Penetap --}}
        <div class="col-md-6">
          <label class="fw-bold">Pejabat Penetap</label>
          <input list="pejabatList" name="pejabat_penetap" class="form-control" placeholder="Ketik atau pilih pejabat penetap">
          <datalist id="pejabatList">
            @foreach ($pejabat as $p)
              <option value="{{ $p->nama_pejabat_penetap }}">
            @endforeach
          </datalist>
        </div>

        {{-- Jabatan Pejabat Penetap --}}
        <div class="col-md-6">
          <label class="fw-bold">Jabatan Pejabat Penetap</label>
          <input list="jabatanPejabatList" name="jabatan_pejabat_penetap" class="form-control" placeholder="Ketik atau pilih jabatan pejabat">
          <datalist id="jabatanPejabatList">
            @foreach ($jabatanPejabatPenetap as $jp)
              <option value="{{ $jp->nama_jabatan_pejabat_penetap }}">
            @endforeach
          </datalist>
        </div>

        {{-- Nomor Surat --}}
        <div class="col-md-6">
          <label class="fw-bold">Nomor Surat</label>
          <input type="text" name="no_sk" class="form-control" placeholder="Masukkan nomor surat...">
        </div>

        {{-- Tanggal KGB Sebelumnya --}}
        <div class="col-md-6">
          <label class="fw-bold">Tanggal KGB Sebelumnya</label>
          <input type="date" name="tmt_pangkat_01" class="form-control">
        </div>

        {{-- Masa Kerja --}}
        <div class="col-md-3">
          <label class="fw-bold">Masa Kerja (Tahun)</label>
          <input type="number" name="masa_kerja_tahun" class="form-control" min="0" placeholder="Tahun">
        </div>

        <div class="col-md-3">
          <label class="fw-bold">Masa Kerja (Bulan)</label>
          <input type="number" name="masa_kerja_bulan" class="form-control" min="0" max="11" placeholder="Bulan">
        </div>

        {{-- Tanggal KGB Sekarang --}}
        <div class="col-md-6">
          <label class="fw-bold">Tanggal KGB Sekarang</label>
          <input type="date" name="tmt_kgb" class="form-control">
        </div>

        {{-- Gaji Pokok Baru --}}
        <div class="col-md-6">
          <label class="fw-bold">Gaji Pokok Baru</label>
          <input list="gajiList" name="nominal_gaji_baru" class="form-control" placeholder="Ketik atau pilih nominal gaji">
        </div>

        {{-- Tanggal --}}
        <div class="col-md-6">
          <label class="fw-bold">Tanggal</label>
          <input type="date" name="tanggal" class="form-control">
        </div>

        {{-- Masa Kerja Selanjutnya --}}
        <div class="col-md-3">
          <label class="fw-bold">Masa Kerja Selanjutnya (Tahun)</label>
          <input type="number" name="mkg_tahun_selanjutnya" class="form-control" min="0" placeholder="Tahun">
        </div>

        <div class="col-md-3">
          <label class="fw-bold">Masa Kerja Selanjutnya (Bulan)</label>
          <input type="number" name="mkg_bulan_selanjutnya" class="form-control" min="0" max="11" placeholder="Bulan">
        </div>

        {{-- KGB Selanjutnya --}}
        <div class="col-md-6">
          <label class="fw-bold">Tanggal KGB Selanjutnya</label>
          <input type="date" name="kgb_selanjutnya" class="form-control">
        </div>
      </div>

      {{-- ================== TOMBOL AKSI ================== --}}
      <div class="text-end mt-5">
        <button type="submit" class="btn btn-success px-4">
          <i class="fas fa-save me-1"></i> Simpan
        </button>
        <a href="{{ route('pegawai.index') }}" class="btn btn-secondary px-4">
          <i class="fas fa-times me-1"></i> Batal
        </a>
      </div>

    </form>
  </div>
</div>

<style>
    label {
        font-size: 0.95rem;
    }

    .form-control {
        border-radius: 10px;
    }

    .btn {
        border-radius: 8px;
    }

    .card {
        border-radius: 12px;
    }

    .row.g-4 {
        margin-left: 5px;
        margin-right: 5px;
    }
</style>
@endsection
