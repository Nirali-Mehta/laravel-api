<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 26 May 2019 19:24:26 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class ModelHasRole
 * 
 * @property int $role_id
 * @property string $model_type
 * @property int $model_id
 * 
 * @property \App\Models\Role $role
 *
 * @package App\Models
 */
class ModelHasRole extends Eloquent
{
	protected $primaryKey = 'model_id';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'role_id' => 'int',
		'model_id' => 'int'
	];

	protected $fillable = [
		'role_id',
		'model_type'
	];

	public function role()
	{
		return $this->belongsTo(\App\Models\Role::class);
	}
}
