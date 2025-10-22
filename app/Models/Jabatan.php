<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Jabatan extends Model
{
    use HasFactory;

    protected $table = 'jabatan';
    protected $primaryKey = 'id_jabatan';
    public $timestamps = false;

    protected $fillable = ['nama_jabatan'];

    public function skKgb()
    {
        return $this->hasMany(SkKgb::class, 'id_jabatan', 'id_jabatan');
    }
}

