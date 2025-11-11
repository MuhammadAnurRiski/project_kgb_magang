<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class JabatanPejabatPenetap
 * 
 * @property int $id_jabatan_pejabat_penetap
 * @property string $nama_jabatan_pejabat_penetap
 *
 * @package App\Models
 */
class JabatanPejabatPenetap extends Model
{
	protected $table = 'jabatan_pejabat_penetap';
	protected $primaryKey = 'id_jabatan_pejabat_penetap';
	public $timestamps = false;

	protected $fillable = [
		'nama_jabatan_pejabat_penetap'
	];
}
