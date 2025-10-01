<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class GolPangkat
 * 
 * @property int $id_gol_pangkat
 * @property string $nama_gol_pangkat
 * 
 * @property Collection|SkKgb[] $sk_kgbs
 *
 * @package App\Models
 */
class GolPangkat extends Model
{
	protected $table = 'gol_pangkat';
	protected $primaryKey = 'id_gol_pangkat';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id_gol_pangkat' => 'int'
	];

	protected $fillable = [
		'nama_gol_pangkat'
	];

	public function sk_kgbs()
	{
		return $this->hasMany(SkKgb::class, 'id_gol_pangkat');
	}
}
