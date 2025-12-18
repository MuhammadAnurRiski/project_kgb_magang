<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use App\Models\Jabatan;
use App\Models\PejabatPenetap;
use App\Models\JabatanPejabatPenetap;
use App\Models\Gaji;
use App\Models\PangkatGolongan;


class PegawaiController extends Controller
{
    //CRUD pegawai
    //read all
    public function index(Request $request)
    {
    $query = Pegawai::query();
    


    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->where('nama_pegawai', 'like', "%{$search}%")
              ->orWhere('nip', 'like', "%{$search}%")
              ->orWhere('jabatan', 'like', "%{$search}%");
        });
    }

   $pegawai = $query->paginate(10)->appends(['search' => $request->search]);
    return view('pegawai.index', compact('pegawai'));
}

    //Read byid
    public function show($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        $nominal_gaji = Gaji::where('nominal_gaji', $pegawai->nominal_gaji)->first();
        return view('pegawai.show', compact(
            'pegawai'));
    }

    // Other CRUD methods (create, store, show, edit, update, destroy) would go here
    //Create
    public function create()
    {
        $pangkat_golongan = PangkatGolongan::all();
        $masa_kerja_golongan = \App\Models\MasaKerjaGolongan::all();
        // Ambil data referensi dari tabel lain
        $jabatan = Jabatan::all();
        $pejabat = PejabatPenetap::all();
        $jabatanPejabatPenetap = JabatanPejabatPenetap::all();
        $gajiOptions = Gaji::pluck('nominal_gaji')->toArray();

        return view('pegawai.create', compact(
            'jabatan',
            'masa_kerja_golongan',
            'pangkat_golongan',
            'pejabat',
            'jabatanPejabatPenetap',
            'gajiOptions'
        ));
    }

    public function store(Request $request)
    {
    $request->validate([
        'nama_pegawai' => 'required|string|max:255',
        'nip' => 'required|string|max:18',
        'jabatan' => 'required|string|max:255',
        'pangkat_golongan' => 'required|string|max:255',
        'tmt_pangkat' => 'nullable|date',
    ]);
    $toNull = function($val) {
    return $val === "" ? null : $val;
};

$cleanNumber = function($val) {
    return $val ? preg_replace('/[^0-9]/', '', $val) : null;
};

    Pegawai::create([
    'nama_pegawai' => $request->nama_pegawai,
    'nip' => $request->nip,
    'jabatan' => $request->jabatan,
    'pangkat_golongan' => $request->pangkat_golongan,
    'tmt_pangkat' => $toNull($request->tmt_pangkat),
    'tmt_pangkat_01' => $toNull($request->tmt_pangkat_01),
    'tmt_kgb' => $toNull($request->tmt_kgb),

    'masa_kerja_tahun' => $toNull($request->masa_kerja_tahun),
    'masa_kerja_bulan' => $toNull($request->masa_kerja_bulan),

    'nominal_gaji' => $cleanNumber($request->nominal_gaji),
    'nominal_gaji_baru' => $cleanNumber($request->nominal_gaji_baru),

    'no_sk' => $toNull($request->no_sk),
    'pejabat_penetap' => $toNull($request->pejabat_penetap),
    'jabatan_pejabat_penetap' => $toNull($request->jabatan_pejabat_penetap),
    'kgb_selanjutnya' => $toNull($request->kgb_selanjutnya),
    'tanggal' => $toNull($request->tanggal),

    'mkg_tahun_selanjutnya' => $toNull($request->mkg_tahun_selanjutnya),
    'mkg_bulan_selanjutnya' => $toNull($request->mkg_bulan_selanjutnya),
]);

    return redirect()->route('pegawai.index')->with('success', 'Pegawai created successfully.');
}



// Update data profil pegawai
public function edit($id)
{
    $pegawai = Pegawai::findOrFail($id);
    $pangkat_golongan = PangkatGolongan::all();
    return view('pegawai.edit', compact(
        'pegawai',
        'pangkat_golongan'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'nama_pegawai' => 'required|string|max:255',
        'nip' => 'required|string|max:18',
        'jabatan' => 'required|string|max:255',
        'pangkat_golongan' => 'required|string|max:255',
        'tmt_pangkat' => 'nullable|date', // tidak wajib
    ]);

    $pegawai = Pegawai::findOrFail($id);
    $pegawai->update(array_filter([
        'nama_pegawai' => $request->nama_pegawai,
        'nip' => $request->nip,
        'jabatan' => $request->jabatan,
        'pangkat_golongan' => $request->pangkat_golongan,
        'tmt_pangkat' => $request->tmt_pangkat,
        
    ], fn ($value) => !is_null($value)));

    return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil diperbarui.');
}

// Update data KGB pegawai
public function editKGB($id)
{
    $pegawai = Pegawai::findOrFail($id);
    $gajiOptions = Gaji::pluck('nominal_gaji')->toArray();
    return view('pegawai.editkgb', compact(
        'pegawai',
        'gajiOptions'));
}

public function updateKGB(Request $request, $id)
{
    Pegawai::where('id_pegawai', $id)->update([
        'tmt_pangkat' => $request->tmt_pangkat,
        'tmt_kgb' => $request->tmt_kgb,
        'tmt_pangkat_01'=>$request->tmt_pangkat_01,

        // 🔽 pastikan hanya angka yang disimpan
        'nominal_gaji' => preg_replace('/[^0-9]/', '', $request->nominal_gaji),
        'nominal_gaji_baru' => preg_replace('/[^0-9]/', '', $request->nominal_gaji_baru),

        'no_sk' => $request->no_sk,
        'masa_kerja_tahun' => $request->masa_kerja_tahun,
        'masa_kerja_bulan' => $request->masa_kerja_bulan,
        'mkg_tahun_selanjutnya' => $request->mkg_tahun_selanjutnya,
        'mkg_bulan_selanjutnya' => $request->mkg_bulan_selanjutnya,
        'tanggal' => $request->tanggal,
        'kgb_selanjutnya' => $request->kgb_selanjutnya,
        'pejabat_penetap' => $request->pejabat_penetap,
        'jabatan_pejabat_penetap' => $request->jabatan_pejabat_penetap,
    ]);

    return redirect()->route('pegawai.index')->with('success', 'Data KGB berhasil diperbarui.');
}



    //delete
    public function destroy($id)
    {
        $pegawai = Pegawai::findOrFail($id);

         // Hapus surat-surat yang terkait
    $pegawai->surats()->delete(); // pastikan relasi sudah dibuat di model Pegawai
        $pegawai->delete();

        return redirect()->route('pegawai.index')->with('success', 'Pegawai deleted successfully.');
    }
}