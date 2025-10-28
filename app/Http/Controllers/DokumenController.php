<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DokumenController extends Controller
{
    public function index()
    {
        // Ini menampilkan halaman utama manajemen dokumen
        return view('dokumen.index');
    }
}
