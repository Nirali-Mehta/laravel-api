<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 26 May 2019 19:24:26 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class Role
 * 
 * @property int $id
 * @property string $name
 * @property string $guard_name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $model_has_roles
 * @property \Illuminate\Database\Eloquent\Collection $permissions
 *
 * @package App\Models
 */
class Role extends Eloquent
{
	protected $fillable = [
		'name',
		'guard_name'
	];

	public function model_has_roles()
	{
		return $this->hasMany(\App\Models\ModelHasRole::class);
	}

	public function permissions()
	{
		return $this->belongsToMany(\App\Models\Permission::class, 'role_has_permissions');
	}
}
