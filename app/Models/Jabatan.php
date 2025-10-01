<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Jabatan
 * 
 * @property int $id_jabatan
 * @property string $nama_jabatan
 * 
 * @property Collection|SkKgb[] $sk_kgbs
 *
 * @package App\Models
 */
class Jabatan extends Model
{
	protected $table = 'jabatan';
	protected $primaryKey = 'id_jabatan';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id_jabatan' => 'int'
	];

	protected $fillable = [
		'nama_jabatan'
	];

	public function sk_kgbs()
	{
		return $this->hasMany(SkKgb::class, 'id_jabatan');
	}
}
