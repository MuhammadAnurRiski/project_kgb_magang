<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Dokuman
 * 
 * @property int $id
 * @property string $folder_name
 * @property string|null $file_name
 * @property string|null $mime_type
 * @property int $file_size
 * @property string|null $file_data
 * @property int|null $uploaded_by
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property bool $is_folders
 *
 * @package App\Models
 */
class Dokuman extends Model
{
	protected $table = 'dokumen';

	protected $casts = [
		'file_size' => 'int',
		'uploaded_by' => 'int',
		'is_folders' => 'bool'
	];

	protected $fillable = [
		'folder_name',
		'file_name',
		'mime_type',
		'file_size',
		'file_data',
		'uploaded_by',
		'is_folders'
	];

}
