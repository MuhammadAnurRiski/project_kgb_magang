<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Pegawai extends Model
{
    use HasFactory;

    protected $table = 'pegawai';
    protected $primaryKey = 'id_pegawai';
    public $timestamps = false;

    protected $fillable = ['nama_pegawai', 'NIP'];

    // Relasi ke SK KGB — pakai kolom NIP
    public function skKgb()
    {
        return $this->hasOne(SkKgb::class, 'NIP', 'NIP');
    }
}
