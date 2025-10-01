<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MasakerjaGol
 * 
 * @property string $id_mkg
 * @property int $tahun_mkg
 *
 * @package App\Models
 */
class MasakerjaGol extends Model
{
	protected $table = 'masakerja_gol';
	protected $primaryKey = 'id_mkg';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'tahun_mkg' => 'int'
	];

	protected $fillable = [
		'tahun_mkg'
	];
}
