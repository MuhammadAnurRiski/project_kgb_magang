<div class="row mb-3">
    <div class="col-md-6">
        <label>Nama</label>
        <input type="text" name="nama_pegawai" class="form-control" value="{{ old('nama_pegawai', $pegawai->nama_pegawai ?? '') }}">
    </div>
    <div class="col-md-6">
        <label>NIP</label>
        <input type="text" name="NIP" class="form-control" value="{{ old('NIP', $pegawai->NIP ?? '') }}">
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-6">
        <label>Jabatan</label>
        <select name="id_jabatan" class="form-select">
            <option value="">-- Pilih Jabatan --</option>
            @foreach($jabatans as $j)
                <option value="{{ $j->id_jabatan }}" {{ (isset($pegawai) && optional($pegawai->skKgb)->id_jabatan == $j->id_jabatan) ? 'selected' : '' }}>
                    {{ $j->nama_jabatan }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <label>TMT</label>
        <input type="date" name="tmt_gaji_baru" class="form-control" value="{{ old('tmt_gaji_baru', optional($pegawai->skKgb)->tmt_gaji_baru) }}">
    </div>
</div>
