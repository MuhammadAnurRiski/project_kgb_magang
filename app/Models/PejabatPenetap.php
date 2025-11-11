<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PejabatPenetap
 * 
 * @property int $id_pejabat_penetap
 * @property string $nama_pejabat_penetap
 *
 * @package App\Models
 */
class PejabatPenetap extends Model
{
	protected $table = 'pejabat_penetap';
	protected $primaryKey = 'id_pejabat_penetap';
	public $timestamps = false;

	protected $fillable = [
		'nama_pejabat_penetap'
	];
}
