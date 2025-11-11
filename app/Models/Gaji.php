<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Gaji
 * 
 * @property int $id_gaji
 * @property int $nominal_gaji
 *
 * @package App\Models
 */
class Gaji extends Model
{
	protected $table = 'gaji';
	protected $primaryKey = 'id_gaji';
	public $timestamps = false;

	protected $casts = [
		'nominal_gaji' => 'int'
	];

	protected $fillable = [
		'nominal_gaji'
	];
}
