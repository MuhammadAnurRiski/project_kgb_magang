<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Pengaturan
 * 
 * @property int $id
 * @property string|null $nama_instansi
 * @property string|null $logo_instansi
 * @property string|null $tanda_tangan
 * @property string|null $alamat_instansi
 *
 * @package App\Models
 */
class Pengaturan extends Model
{
	protected $table = 'pengaturan';
	public $timestamps = false;

	protected $fillable = [
		'nama_instansi',
		'logo_instansi',
		'tanda_tangan',
		'alamat_instansi'
	];
}
