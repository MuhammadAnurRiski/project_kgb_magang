<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PangkatGolongan
 * 
 * @property int $id_pangkat_golongan
 * @property string $nama_pangkat_golongan
 *
 * @package App\Models
 */
class PangkatGolongan extends Model
{
	protected $table = 'pangkat_golongan';
	protected $primaryKey = 'id_pangkat_golongan';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id_pangkat_golongan' => 'int'
	];

	protected $fillable = [
		'nama_pangkat_golongan'
	];
}
