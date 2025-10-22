<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class SuratController extends Controller
{
    public function index()
    {
        return view('surat.index');
    }

    public function cetak($id)
    {
        $surat = \App\Models\SkKgb::with(['jabatan', 'golongan', 'unitKerja', 'pejabat'])
            ->findOrFail($id);

        return view('surat.cetak', compact('surat'));
    }
}
