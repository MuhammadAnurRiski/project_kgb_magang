<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SkKgb
 * 
 * @property int $id_sk
 * @property string $nama
 * @property int $NIP
 * @property string $nomor_surat
 * @property Carbon $tanggal_surat
 * @property int $id_gol_pangkat
 * @property int $id_jabatan
 * @property int $id_unit_kerja
 * @property int $gaji_pokok_lama
 * @property Carbon $tmt_gaji_baru
 * @property int $masa_kerja_baru_thn
 * @property int $masa_kerja_baru_bln
 * @property int $gaji_pokok_baru
 * @property Carbon $tmt_kgb_berikutnya
 * @property int $id_pejabat
 * 
 * @property GolPangkat $gol_pangkat
 * @property UnitKerjaMaster $unit_kerja_master
 * @property Jabatan $jabatan
 * @property MasterPejabat $master_pejabat
 *
 * @package App\Models
 */
class SkKgb extends Model
{
	protected $table = 'sk_kgb';
	protected $primaryKey = 'id_sk';
	public $timestamps = false;

	protected $casts = [
		'NIP' => 'int',
		'tanggal_surat' => 'datetime',
		'id_gol_pangkat' => 'int',
		'id_jabatan' => 'int',
		'id_unit_kerja' => 'int',
		'gaji_pokok_lama' => 'int',
		'tmt_gaji_baru' => 'datetime',
		'masa_kerja_baru_thn' => 'int',
		'masa_kerja_baru_bln' => 'int',
		'gaji_pokok_baru' => 'int',
		'tmt_kgb_berikutnya' => 'datetime',
		'id_pejabat' => 'int'
	];

	protected $fillable = [
		'nama',
		'NIP',
		'nomor_surat',
		'tanggal_surat',
		'id_gol_pangkat',
		'id_jabatan',
		'id_unit_kerja',
		'gaji_pokok_lama',
		'tmt_gaji_baru',
		'masa_kerja_baru_thn',
		'masa_kerja_baru_bln',
		'gaji_pokok_baru',
		'tmt_kgb_berikutnya',
		'id_pejabat'
	];

	public function gol_pangkat()
	{
		return $this->belongsTo(GolPangkat::class, 'id_gol_pangkat');
	}

	public function unit_kerja_master()
	{
		return $this->belongsTo(UnitKerjaMaster::class, 'id_unit_kerja');
	}

	public function jabatan()
	{
		return $this->belongsTo(Jabatan::class, 'id_jabatan');
	}

	public function master_pejabat()
	{
		return $this->belongsTo(MasterPejabat::class, 'id_pejabat');
	}
}

