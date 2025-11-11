<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaturan;
use Illuminate\Support\Facades\Storage;

class PengaturanController extends Controller
{
    public function index()
    {
        $pengaturan = Pengaturan::first();
        return view('pengaturan.index', compact('pengaturan'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama_instansi' => 'required|string|max:255',
            'alamat_instansi' => 'nullable|string',
            'logo_instansi' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'tanda_tangan' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        $pengaturan = Pengaturan::first() ?? new Pengaturan();

        // Upload logo instansi
        if ($request->hasFile('logo_instansi')) {
            if ($pengaturan->logo_instansi && Storage::exists('public/' . $pengaturan->logo_instansi)) {
                Storage::delete('public/' . $pengaturan->logo_instansi);
            }

            $file = $request->file('logo_instansi');
            $filename = 'logo_instansi_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('logos', $filename, 'public');
            $pengaturan->logo_instansi = $path;
        }

        // Upload tanda tangan (QR / scan)
        if ($request->hasFile('tanda_tangan')) {
            if ($pengaturan->tanda_tangan && Storage::exists('public/' . $pengaturan->tanda_tangan)) {
                Storage::delete('public/' . $pengaturan->tanda_tangan);
            }

            $file = $request->file('tanda_tangan');
            $filename = 'tanda_tangan_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('tandatangan', $filename, 'public');
            $pengaturan->tanda_tangan = $path;
        }

        $pengaturan->nama_instansi = $request->nama_instansi;
        $pengaturan->alamat_instansi = $request->alamat_instansi;
        $pengaturan->save();

        return redirect()->back()->with('success', 'Pengaturan berhasil diperbarui.');
    }
}


