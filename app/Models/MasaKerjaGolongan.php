<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MasaKerjaGolongan
 * 
 * @property int $id_masa_kerja_golongan
 * @property int|null $masa_kerja_golongan
 * 
 * @property Collection|Pegawai[] $pegawais
 *
 * @package App\Models
 */
class MasaKerjaGolongan extends Model
{
	protected $table = 'masa_kerja_golongan';
	protected $primaryKey = 'id_masa_kerja_golongan';
	public $timestamps = false;

	protected $casts = [
		'masa_kerja_golongan' => 'int'
	];

	protected $fillable = [
		'masa_kerja_golongan'
	];

	public function pegawais()
	{
		return $this->hasMany(Pegawai::class, 'masa_kerja_tahun');
	}
}
