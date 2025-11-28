@extends('layouts.app')
@section('title', 'Edit Surat KGB')

@section('content')
<style>
  /* === Styling tambahan agar kiri & kanan terlihat terpisah === */
  #preview-area {
    background-color: #fff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    height: 90vh;
    overflow-y: auto;
  }

  .edit-panel {
    background-color: #f9fafc;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    height: 90vh;
    overflow-y: auto;
  }

  .container-fluid {
    background-color: #eef1f5;
    padding: 20px;
    border-radius: 10px;
  }
</style>
<div class="container-fluid mt-4">
  <div class="row">
    {{-- BAGIAN KIRI: Preview Surat --}}
    <div class="col-md-7 border-end" id="preview-area">
      @include('surat.preview', ['pegawai' => $pegawai, 'surat' => $surat])
    </div>

    {{-- BAGIAN KANAN: Form Edit --}}
    <div class="col-md-5">
      <h5 class="fw-bold mb-3 text-secondary">Form Edit Surat</h5>

      {{-- ✅ ID surat, bukan id_pegawai --}}
      <form id="form-edit" data-id="{{ $surat->id }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
          <label>No Surat</label>
          <input type="text" name="nomor_surat" class="form-control"
                 value="{{ $surat->nomor_surat }}" oninput="syncText(this)">
        </div>

        <div class="mb-3">
          <label>Tanggal Surat</label>
          <input type="date" name="tanggal_surat" class="form-control"
                 value="{{ $surat->tanggal_surat }}" oninput="syncDate(this)">
        </div>
        <div class="mb-3">
          <label>Unit Kerja</label>
          <input type="text" name="unit_kerja" class="form-control"
                 value="{{ $surat->unit_kerja }}" oninput="syncText(this)">
        </div>

        <div class="mb-3">
          <label>Oleh</label>
          <input type="text" name="Oleh" class="form-control"
                 value="{{ $surat->Oleh }}" oninput="syncText(this)">
        </div>

        <div class="mb-3">
          <label>Golongan</label>
          <select name="nama_golongan" class="form-control" onchange="syncText(this)">
          <option value="">-- Pilih Golongan --</option>
          @foreach ($golongan as $g)
             <option value="{{ $g }}" {{ $surat->nama_golongan == $g ? 'selected' : '' }}>
            {{ $g }}
          </option>
        @endforeach
      </select>
    </div>  

        <button type="button" id="saveBtn" class="btn btn-success">Simpan</button>
        <a href="{{ route('surat.cetak', $surat->id) }}"class="btn btn-secondary" target="_blank">
           <i class="fas fa-print"></i> Cetak PDF
        </a>
      </form>
    </div>
  </div>
</div>

{{-- ✅ Notifikasi autosave --}}
<div id="autosave-status" style="font-size: 13px; color: green; display: none;">
  ✅ Perubahan tersimpan otomatis
</div>

<script>
function syncText(input) {
  const id = input.name;
  const el = document.getElementById(id);
  if (el) el.innerText = input.value || '..................';
}

function syncDate(input) {
  const id = input.name;
  const el = document.getElementById(id);
  if (!el) return;
  const date = new Date(input.value);
  el.innerText = date.toLocaleDateString('id-ID', {
    day: '2-digit', month: 'long', year: 'numeric'
  });
}

document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('form-edit');
  const inputs = form.querySelectorAll('input, textarea, select');
  let timer;

  inputs.forEach(input => {
    input.addEventListener('input', () => {
      clearTimeout(timer);
      timer = setTimeout(autoSave, 800);
    });
  });

  async function autoSave() {
    const id = form.getAttribute('data-id');
    const formData = new FormData(form);

    try {
      const response = await fetch(`/surat/${id}`, {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
          'X-HTTP-Method-Override': 'PUT'
        },
        body: formData
      });

      const result = await response.json();

      if (result.success) {
        const status = document.getElementById('autosave-status');
        status.style.display = 'block';
        setTimeout(() => status.style.display = 'none', 1500);
      } else {
        console.warn('⚠️ Gagal menyimpan otomatis');
      }
    } catch (error) {
      console.error('❌ Error auto save:', error);
    }
  }
});
</script>
@endsection
