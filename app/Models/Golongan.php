<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Golongan
 * 
 * @property int $id_gol
 * @property string $nama_golongan
 *
 * @package App\Models
 */
class Golongan extends Model
{
	protected $table = 'golongan';
	protected $primaryKey = 'id_gol';
	public $timestamps = false;

	protected $fillable = [
		'nama_golongan'
	];
}
