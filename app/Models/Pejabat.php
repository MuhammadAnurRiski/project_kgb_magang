<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pejabat extends Model
{
    protected $table = 'master_pejabat'; // ✅ tabel yang benar
    protected $primaryKey = 'id_pejabat';
    public $timestamps = false;

    protected $fillable = [
        'nama_pejabat',
        // tambahkan kolom lain kalau ada, misalnya 'nip_pejabat' atau 'jabatan_pejabat'
    ];
}
