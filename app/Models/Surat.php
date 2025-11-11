<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Surat
 * 
 * @property int $id
 * @property string|null $nomor_surat
 * @property int $id_pegawai
 * @property string|null $unit_kerja
 * @property Carbon|null $tanggal_surat
 * @property string|null $Oleh
 * 
 * @property Pegawai $pegawai
 *
 * @package App\Models
 */
class Surat extends Model
{
	protected $table = 'surat';
	public $timestamps = false;

	protected $casts = [
		'id_pegawai' => 'int',
		'tanggal_surat' => 'datetime'
	];

	protected $fillable = [
		'nomor_surat',
		'id_pegawai',
		'unit_kerja',
		'tanggal_surat',
		'Oleh'
	];

	public function pegawai()
	{
		return $this->belongsTo(Pegawai::class, 'id_pegawai');
	}
}
