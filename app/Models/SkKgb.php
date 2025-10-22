<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkKgb extends Model
{
    use HasFactory;

    protected $table = 'sk_kgb';
    protected $primaryKey = 'id_sk';
    public $timestamps = false;

    protected $fillable = [
        'nama',
        'NIP',
        'nomor_surat',
        'tanggal_surat',
        'id_gol_pangkat',
        'id_jabatan',
        'id_unit_kerja',
        'gaji_pokok_lama',
        'tmt_gaji_baru',
        'masa_kerja_baru_thn',
        'masa_kerja_baru_bln',
        'gaji_pokok_baru',
        'tmt_kgb_berikutnya',
        'id_pejabat'
    ];

    /**
     * Relasi ke tabel jabatan
     */
    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'id_jabatan', 'id_jabatan');
    }

    /**
     * Relasi ke tabel gol_pangkat
     */
    public function golongan()
    {
        return $this->belongsTo(Golongan::class, 'id_gol_pangkat', 'id_gol_pangkat');
    }

    /**
     * Relasi ke tabel master_pejabat
     */
    public function pejabat()
    {
        return $this->belongsTo(Pejabat::class, 'id_pejabat', 'id_pejabat');
    }
    
}

