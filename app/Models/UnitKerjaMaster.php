<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UnitKerjaMaster
 * 
 * @property int $id_unit
 * @property string $nama_unit
 * 
 * @property Collection|SkKgb[] $sk_kgbs
 *
 * @package App\Models
 */
class UnitKerjaMaster extends Model
{
	protected $table = 'unit_kerja_master';
	protected $primaryKey = 'id_unit';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id_unit' => 'int'
	];

	protected $fillable = [
		'nama_unit'
	];

	public function sk_kgbs()
	{
		return $this->hasMany(SkKgb::class, 'id_unit_kerja');
	}
}
