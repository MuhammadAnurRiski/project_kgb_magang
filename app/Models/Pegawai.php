<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use App\Models\Surat;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Pegawai
 * 
 * @property int $id_pegawai
 * @property string $nama_pegawai
 * @property int $nip
 * @property string|null $jabatan
 * @property string|null $pangkat_golongan
 * @property Carbon|null $tmt_pangkat_01
 * @property Carbon|null $tmt_pangkat
 * @property Carbon|null $tmt_kgb
 * @property int|null $masa_kerja_tahun
 * @property int|null $masa_kerja_bulan
 * @property int|null $nominal_gaji
 * @property string|null $no_sk
 * @property string|null $pejabat_penetap
 * @property string|null $jabatan_pejabat_penetap
 * @property Carbon|null $kgb_selanjutnya
 * @property int|null $nominal_gaji_baru
 * @property Carbon|null $tanggal
 * @property int|null $mkg_tahun_selanjutnya
 * @property int|null $mkg_bulan_selanjutnya
 * 
 * @property Collection|Dokuman[] $dokumen
 * @property Collection|Surat[] $surats
 *
 * @package App\Models
 */
class Pegawai extends Model
{
	protected $table = 'pegawai';
	protected $primaryKey = 'id_pegawai';
	public $timestamps = false;

	protected $casts = [
		'nip' => 'int',
		'tmt_pangkat_01' => 'date',
		'tmt_pangkat' => 'date',
		'tmt_kgb' => 'date',
		'masa_kerja_tahun' => 'int',
		'masa_kerja_bulan' => 'int',
		'nominal_gaji' => 'int',
		'kgb_selanjutnya' => 'date',
		'nominal_gaji_baru' => 'int',
		'tanggal' => 'date',
		'mkg_tahun_selanjutnya' => 'int',
		'mkg_bulan_selanjutnya' => 'int'
	];

	protected $fillable = [
		'nama_pegawai',
		'nip',
		'jabatan',
		'pangkat_golongan',
		'tmt_pangkat_01',
		'tmt_pangkat',
		'tmt_kgb',
		'masa_kerja_tahun',
		'masa_kerja_bulan',
		'nominal_gaji',
		'no_sk',
		'pejabat_penetap',
		'jabatan_pejabat_penetap',
		'kgb_selanjutnya',
		'nominal_gaji_baru',
		'tanggal',
		'mkg_tahun_selanjutnya',
		'mkg_bulan_selanjutnya'
	];

	public function dokumen()
	{
		return $this->hasMany(Dokuman::class, 'id_pegawai');
	}

	public function surats()
	{
		return $this->hasMany(Surat::class, 'id_pegawai');
	}
}
