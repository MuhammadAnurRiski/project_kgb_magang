<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class KgbHistory
 * 
 * @property int $id
 * @property int $id_pegawai
 * @property Carbon $tmt_kgb
 * @property Carbon $kgb_selanjutnya
 * @property int|null $nominal_gaji
 * @property int|null $nominal_gaji_baru
 * @property int|null $masa_kerja_tahun
 * @property int|null $masa_kerja_bulan
 * @property int|null $mkg_tahun_selanjutnya
 * @property int|null $mkg_bulan_selanjutnya
 * @property string|null $no_sk
 * @property string|null $pejabat_penetap
 * @property string|null $jabatan_pejabat_penetap
 * @property Carbon|null $tanggal
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Pegawai $pegawai
 *
 * @package App\Models
 */
class KgbHistory extends Model
{
	protected $table = 'kgb_histories';

	protected $casts = [
		'id_pegawai' => 'int',
		'tmt_kgb' => 'datetime',
		'kgb_selanjutnya' => 'datetime',
		'nominal_gaji' => 'int',
		'nominal_gaji_baru' => 'int',
		'masa_kerja_tahun' => 'int',
		'masa_kerja_bulan' => 'int',
		'mkg_tahun_selanjutnya' => 'int',
		'mkg_bulan_selanjutnya' => 'int',
		'tanggal' => 'datetime'
	];

	protected $fillable = [
		'id_pegawai',
		'tmt_kgb',
		'kgb_selanjutnya',
		'nominal_gaji',
		'nominal_gaji_baru',
		'masa_kerja_tahun',
		'masa_kerja_bulan',
		'mkg_tahun_selanjutnya',
		'mkg_bulan_selanjutnya',
		'no_sk',
		'pejabat_penetap',
		'jabatan_pejabat_penetap',
		'tanggal'
	];

	public function pegawai()
	{
		return $this->belongsTo(Pegawai::class, 'id_pegawai');
	}
}
