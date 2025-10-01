<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Pegawai
 * 
 * @property int $id_pegawai
 * @property string $nama_pegawai
 * @property int $NIP
 * 
 * @property Collection|SkKgb[] $sk_kgbs
 *
 * @package App\Models
 */
class Pegawai extends Model
{
	protected $table = 'pegawai';
	protected $primaryKey = 'id_pegawai';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id_pegawai' => 'int',
		'NIP' => 'int'
	];

	protected $fillable = [
		'nama_pegawai',
		'NIP'
	];

	public function sk_kgbs()
	{
		return $this->hasMany(SkKgb::class, 'id_pegawai');
	}
}
