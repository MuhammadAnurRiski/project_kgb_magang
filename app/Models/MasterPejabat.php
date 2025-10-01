<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MasterPejabat
 * 
 * @property int $id_pejabat
 * @property string $nama_pejabat
 * @property string $jabatan
 * 
 * @property Collection|SkKgb[] $sk_kgbs
 *
 * @package App\Models
 */
class MasterPejabat extends Model
{
	protected $table = 'master_pejabat';
	protected $primaryKey = 'id_pejabat';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id_pejabat' => 'int'
	];

	protected $fillable = [
		'nama_pejabat',
		'jabatan'
	];

	public function sk_kgbs()
	{
		return $this->hasMany(SkKgb::class, 'id_pejabat');
	}
}
