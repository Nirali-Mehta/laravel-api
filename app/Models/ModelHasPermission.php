<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 31 May 2019 12:53:39 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class ModelHasPermission
 * 
 * @property int $permission_id
 * @property string $model_type
 * @property int $model_id
 * 
 * @property \App\Models\Permission $permission
 *
 * @package App\Models
 */
class ModelHasPermission extends Eloquent
{
	protected $primaryKey = 'model_id';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'permission_id' => 'int',
		'model_id' => 'int'
	];

	protected $fillable = [
		'permission_id',
		'model_type'
	];

	public function permission()
	{
		return $this->belongsTo(\App\Models\Permission::class);
	}
	
}
