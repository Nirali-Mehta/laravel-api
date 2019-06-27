<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 26 May 2019 19:24:26 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class Category
 * 
 * @property int $id
 * @property int $parent_id
 * @property int $branch_id
 * @property string $name
 * @property string $slug
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $products
 *
 * @package App\Models
 */
class Category extends Eloquent
{
	protected $casts = [
		'parent_id' => 'int',
		'branch_id' => 'int'
	];

	protected $fillable = [
		'parent_id',
		'branch_id',
		'name',
		'slug'
	];

	public function products()
	{
		return $this->hasMany(\App\Models\Product::class);
	}
}
