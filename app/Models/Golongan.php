<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Golongan extends Model
{
    protected $table = 'gol_pangkat'; // nama tabel di database
    protected $primaryKey = 'id_gol_pangkat';
    public $timestamps = false;

    protected $fillable = [
        'nama_gol_pangkat',
    ];
}
