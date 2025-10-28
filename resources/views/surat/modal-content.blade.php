<div class="container-fluid py-3" data-pegawai-id="{{ $pegawai->id_sk }}">
    <div class="row">
        <div class="col-12">
            <h5 class="fw-bold text-primary border-bottom pb-2">Cetak Pengajuan KGB</h5>
        </div>
    </div>

    {{-- ===================== IDENTITAS PEGAWAI ===================== --}}
    <div class="row mt-3">
        <div class="col-md-6 mb-3">
            <label class="fw-bold">Nama</label>
            <input type="text" class="form-control bg-light" value="{{ $pegawai->nama }}" readonly>
        </div>
        <div class="col-md-3 mb-3">
            <label class="fw-bold">Masa Kerja</label>
            <input type="text" class="form-control bg-light" value="{{ $pegawai->masa_kerja ?? '-' }}" readonly>
        </div>
        <div class="col-md-3 mb-3">
            <label class="fw-bold">Nominal Gaji</label>
            <input type="text" class="form-control bg-light" 
                   value="Rp{{ number_format($pegawai->gaji_lama ?? 0, 0, ',', '.') }}" readonly>
        </div>

        <div class="col-md-6 mb-3">
            <label class="fw-bold">NIP</label>
            <input type="text" class="form-control bg-light" value="{{ $pegawai->NIP }}" readonly>
        </div>
        <div class="col-md-6 mb-3">
            <label class="fw-bold">Jabatan</label>
            <input type="text" class="form-control bg-light" 
                   value="{{ optional($pegawai->jabatan)->nama_jabatan ?? '-' }}" readonly>
        </div>

        <div class="col-md-6 mb-3">
            <label class="fw-bold">Pangkat/Gol. Ruang</label>
            <input type="text" class="form-control bg-light" 
                   value="({{ optional($pegawai->golongan)->golongan ?? '-' }}) {{ optional($pegawai->golongan)->pangkat ?? '-' }}" readonly>
        </div>
        <div class="col-md-6 mb-3">
            <label class="fw-bold">Pejabat Penetap</label>
            <input type="text" class="form-control bg-light" 
                   value="{{ optional($pegawai->pejabat)->nama_pejabat ?? '-' }}" readonly>
        </div>

        <div class="col-md-6 mb-3">
            <label class="fw-bold">TMT Pangkat</label>
            <div class="input-group">
                <span class="input-group-text bg-light"><i class="fas fa-calendar"></i></span>
                <input type="text" class="form-control bg-light" 
                       value="{{ \Carbon\Carbon::parse($pegawai->tmt_pangkat ?? now())->format('d/m/Y') }}" readonly>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <label class="fw-bold">No. SK</label>
            <input type="text" class="form-control bg-light" value="{{ $pegawai->no_sk ?? '-' }}" readonly>
        </div>
    </div>

    {{-- ===================== DATA KGB ===================== --}}
    <div class="row mt-4">
        <div class="col-12">
            <h6 class="fw-bold fst-italic bg-light p-2 rounded">Data Kenaikan Gaji Berkala</h6>
        </div>

        <div class="col-md-4 mb-3">
            <label class="fw-bold">TMT KGB</label>
            <div class="input-group">
                <span class="input-group-text bg-light"><i class="fas fa-calendar"></i></span>
                <input type="text" class="form-control bg-light" 
                       value="{{ \Carbon\Carbon::parse($pegawai->tmt_gaji_baru ?? now())->format('d/m/Y') }}" readonly>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <label class="fw-bold">Pangkat/Gol. Ruang KGB</label>
            <input type="text" class="form-control bg-light" 
                   value="{{ optional($pegawai->golongan)->golongan ?? '-' }}" readonly>
        </div>

        <div class="col-md-4 mb-3">
            <label class="fw-bold">Nomor Surat KGB</label>
            <input type="text" class="form-control bg-light" value="{{ $pegawai->nomor_surat ?? '-' }}" readonly>
        </div>

        <div class="col-md-3 mb-3">
            <label class="fw-bold">Masa Kerja</label>
            <input type="text" class="form-control bg-light" value="{{ $pegawai->masa_kerja_baru ?? '-' }}" readonly>
        </div>
        <div class="col-md-3 mb-3">
            <label class="fw-bold">Nominal Gaji</label>
            <input type="text" class="form-control bg-light" 
                   value="Rp{{ number_format($pegawai->gaji_baru ?? 0, 0, ',', '.') }}" readonly>
        </div>
        <div class="col-md-3 mb-3">
            <label class="fw-bold">KGB Selanjutnya</label>
            <div class="input-group">
                <span class="input-group-text bg-light"><i class="fas fa-calendar"></i></span>
                <input type="text" class="form-control bg-light" 
                       value="{{ \Carbon\Carbon::parse($pegawai->kgb_selanjutnya ?? now())->format('d/m/Y') }}" readonly>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <label class="fw-bold">Pejabat Penetap KGB</label>
            <input type="text" class="form-control bg-light" 
                   value="{{ optional($pegawai->pejabat)->nama_pejabat ?? '-' }}" readonly>
        </div>
    </div>
</div>
