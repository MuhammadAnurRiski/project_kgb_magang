<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Dokuman;

class DokumenController extends Controller
{
    /**
     * Tampilkan daftar folder utama.
     */
  public function index(Request $request)
{
    $search = $request->query('search');

    $folders = Dokuman::where('is_folders', true)
        ->when($search, function ($query, $search) {
            $query->where('folder_name', 'like', "%{$search}%");
        })
        ->orderBy('folder_name')
        ->get();

    return view('dokumen.index', compact('folders', 'search'));
}


    /**
     * Tampilkan isi folder.
     */
   public function showFolder(Request $request, $folderName)
{
    $search = $request->query('search');

    $files = Dokuman::where('folder_name', $folderName)
        ->where('is_folders', false)
        ->when($search, function ($query, $search) {
            $query->where('file_name', 'like', "%{$search}%");
        })
        ->orderBy('created_at', 'desc')
        ->get();

    return view('dokumen.folder', compact('folderName', 'files', 'search'));
}


    /**
     * Buat folder baru.
     */
    public function createFolder(Request $request)
    {
        $request->validate([
            'folder_name' => 'required|string|max:255',
        ]);

        // Cek apakah folder sudah ada
        if (Dokuman::where('folder_name', $request->folder_name)
            ->where('is_folders', true)
            ->exists()
        ) {
            return back()->with('error', 'Folder sudah ada!');
        }

        Dokuman::create([
            'folder_name' => $request->folder_name,
            'file_name'   => $request->folder_name,
            'mime_type'   => null,
            'file_size'   => 0,
            'file_data'   => null,
            'uploaded_by' => auth()->id() ?? null,
            'is_folders'  => true,
        ]);

        return back()->with('success', 'Folder berhasil dibuat.');
    }

    /**
     * Upload file ke folder (disimpan dalam database).
     */
    public function uploadFile(Request $request)
    {
        $request->validate([
            'folder_name' => 'required|string|max:255',
            'file'        => 'required|file|max:10240', // Maks 10MB
        ]);

        $file = $request->file('file');

        Dokuman::create([
            'folder_name' => $request->folder_name,
            'file_name'   => $file->getClientOriginalName(),
            'mime_type'   => $file->getMimeType(),
            'file_size'   => $file->getSize(),
            'file_data'   => file_get_contents($file->getRealPath()),
            'uploaded_by' => auth()->id() ?? null,
            'is_folders'  => false,
        ]);

        return back()->with('success', 'File berhasil diunggah ke database.');
    }

    /**
     * Lihat atau unduh file.
     */
    public function viewFile($id)
    {
        $file = Dokuman::find($id);

        if (!$file) {
            abort(404, 'File tidak ditemukan.');
        }

        if ($file->is_folders || empty($file->file_data)) {
            abort(404, 'Bukan file atau file kosong.');
        }

        return response($file->file_data)
            ->header('Content-Type', $file->mime_type)
            ->header('Content-Disposition', 'inline; filename="' . $file->file_name . '"');
    }

    /**
     * Hapus file atau folder.
     */
    public function deleteFile($id)
    {
        $file = Dokuman::find($id);

        if (!$file) {
            return back()->with('error', 'File tidak ditemukan.');
        }

        // Jika folder, hapus juga semua file di dalamnya
        if ($file->is_folders) {
            Dokuman::where('folder_name', $file->folder_name)
                ->where('is_folders', false)
                ->delete();
        }

        $file->delete();

        return back()->with('success', 'Data berhasil dihapus.');
    }

    public function deleteFolder($id)
{
    $folder = Dokuman::find($id);

    if (!$folder || !$folder->is_folders) {
        return back()->with('error', 'Folder tidak ditemukan.');
    }

    // Hapus semua file di dalam folder
    Dokuman::where('folder_name', $folder->folder_name)
        ->where('is_folders', false)
        ->delete();

    // Hapus folder itu sendiri
    $folder->delete();

    return back()->with('success', 'Folder dan semua isinya berhasil dihapus.');
}

public function deleteMultiple(Request $request)
{
    $ids = $request->input('selected_folders');

    if (!$ids || count($ids) === 0) {
        return redirect()->route('dokumen.index')->with('error', 'Tidak ada folder yang dipilih.');
    }

    // Hapus semua folder berdasarkan ID
    $deleted = Dokuman::whereIn('id', $ids)->delete();

    return redirect()->route('dokumen.index')->with('success', "$deleted folder berhasil dihapus.");
}

}
