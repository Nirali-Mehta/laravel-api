<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 26 May 2019 19:24:26 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class Menu
 * 
 * @property int $id
 * @property int $branch_id
 * @property string $name
 * @property string $slug
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Branch $branch
 * @property \Illuminate\Database\Eloquent\Collection $products
 *
 * @package App\Models
 */
class Menu extends Eloquent
{
	protected $casts = [
		'branch_id' => 'int'
	];

	protected $fillable = [
		'branch_id',
		'name',
		'slug'
	];

	public function branch()
	{
		return $this->belongsTo(\App\Models\Branch::class);
	}

	public function products()
	{
		return $this->belongsToMany(\App\Models\Product::class);
	}
}
