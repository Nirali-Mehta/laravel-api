<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 26 May 2019 19:24:26 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class BranchType
 * 
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $branches
 *
 * @package App\Models
 */
class BranchType extends Eloquent
{
	protected $fillable = [
		'name',
		'slug'
	];

	public function branches()
	{
		return $this->hasMany(\App\Models\Branch::class);
	}
}
