<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SkKgb;
use App\Models\Jabatan;

class PegawaiController extends Controller
{
    /**
     * 🏠 Tampilkan daftar pegawai
     */
    public function index()
    {
        // Ambil data pegawai dari tabel sk_kgb + relasi jabatan
        $pegawais = SkKgb::with('jabatan')
            ->orderBy('nama', 'asc')
            ->get();

        return view('pegawai.index', compact('pegawais'));
    }

    /**
     * ➕ Tampilkan form tambah pegawai
     */
    public function create()
    {
        // Ambil semua data relasi yang dibutuhkan untuk form
        $jabatans = \App\Models\Jabatan::orderBy('nama_jabatan', 'asc')->get();
        $golongans = \App\Models\Golongan::orderBy('nama_gol_pangkat', 'asc')->get();
        $pejabats = \App\Models\Pejabat::orderBy('nama_pejabat', 'asc')->get();

        // Kirim ke view
        return view('pegawai.create', compact('jabatans', 'golongans', 'pejabats'));
    }


    /**
     * 💾 Simpan data pegawai baru
     */
   public function store(Request $request)
{
    $request->validate([
        'nama' => 'required|string|max:100',
        'NIP' => 'required|numeric|unique:sk_kgb,NIP',
        'id_jabatan' => 'required|integer',
        'tmt_gaji_baru' => 'nullable|date'
    ]);

    SkKgb::create([
        'nama' => $request->nama,
        'NIP' => $request->NIP,
        'id_jabatan' => $request->id_jabatan,
        'tmt_gaji_baru' => $request->tmt_gaji_baru,
        'nomor_surat' => 'Auto Generated',
        'tanggal_surat' => now(),
        'id_gol_pangkat' => 1,
        'id_unit_kerja' => 1,
        'gaji_pokok_lama' => 0,
        'masa_kerja_baru_thn' => 0,
        'masa_kerja_baru_bln' => 0,
        'gaji_pokok_baru' => 0,
        'tmt_kgb_berikutnya' => now()->addYear(),
        'id_pejabat' => 1,
    ]);

    return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil ditambahkan.');
}

    /**
     * 👀 Tampilkan detail pegawai
     */
    public function show($id)
    {
        $pegawai = \App\Models\SkKgb::with(['jabatan', 'golongan', 'pejabat'])
            ->select(
                'id_sk',
                'nama',
                'NIP',
                'id_jabatan',
                'id_gol_pangkat',
                'id_pejabat',
                'gaji_pokok_lama',
                'gaji_pokok_baru',
                'tmt_gaji_baru',
                'tmt_kgb_berikutnya',
                'masa_kerja_baru_thn',
                'masa_kerja_baru_bln',
                'nomor_surat',
                'tanggal_surat'
            )
            ->findOrFail($id);
            
        return view('pegawai.show', compact('pegawai'));
    }


    /**
     * ✏️ Tampilkan form edit pegawai
     */
    public function edit($id)
{
    // Ambil data pegawai berdasarkan ID
    $pegawai = \App\Models\SkKgb::with(['jabatan'])->findOrFail($id);

    // Ambil data relasi untuk dropdown
    $jabatans = \App\Models\Jabatan::orderBy('nama_jabatan', 'asc')->get();
    $golongans = \App\Models\Golongan::orderBy('nama_gol_pangkat', 'asc')->get();
    $pejabats = \App\Models\Pejabat::orderBy('nama_pejabat', 'asc')->get();

    // Kirim semua data ke view edit
    return view('pegawai.edit', compact('pegawai', 'jabatans', 'golongans', 'pejabats'));
}


    /**
     * 🔁 Update data pegawai
     */
    public function update(Request $request, $id)
    {
        $pegawai = SkKgb::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:100',
            'NIP' => 'required|numeric|unique:sk_kgb,NIP,' . $pegawai->id_sk . ',id_sk',
            'id_jabatan' => 'required|integer',
            'tmt_gaji_baru' => 'nullable|date'
        ]);

        $pegawai->update([
            'nama' => $request->nama,
            'NIP' => $request->NIP,
            'id_jabatan' => $request->id_jabatan,
            'tmt_gaji_baru' => $request->tmt_gaji_baru,
        ]);

        return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil diperbarui.');
    }

    /**
     * 🗑️ Hapus data pegawai
     */
    public function destroy($id)
    {
        $pegawai = SkKgb::findOrFail($id);
        $pegawai->delete();

        return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil dihapus.');
    }

    public function cetak($id)
    {
        $surat = \App\Models\SkKgb::with(['jabatan', 'golongan', 'unitKerja', 'pejabat'])
            ->findOrFail($id);
    
        return view('surat.cetak', compact('surat'));
    }
    
}
 