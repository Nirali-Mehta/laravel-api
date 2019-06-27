<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 26 May 2019 19:24:26 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class Product
 * 
 * @property int $id
 * @property int $category_id
 * @property int $unit_id
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property string $profile_image
 * @property string $cover_image
 * @property string $hsn_code
 * @property bool $is_in_stock
 * @property bool $is_weighted_varianted
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Category $category
 * @property \App\Models\Unit $unit
 * @property \Illuminate\Database\Eloquent\Collection $menus
 * @property \Illuminate\Database\Eloquent\Collection $options
 * @property \Illuminate\Database\Eloquent\Collection $variations
 *
 * @package App\Models
 */
class Product extends Eloquent
{
	protected $casts = [
		'category_id' => 'int',
		'unit_id' => 'int',
		'is_in_stock' => 'bool',
		'is_weighted_varianted' => 'bool'
	];

	protected $fillable = [
		'category_id',
		'unit_id',
		'title',
		'slug',
		'description',
		'profile_image',
		'cover_image',
		'hsn_code',
		'is_in_stock',
		'is_weighted_varianted'
	];

	public function category()
	{
		return $this->belongsTo(\App\Models\Category::class);
	}

	public function unit()
	{
		return $this->belongsTo(\App\Models\Unit::class);
	}

	public function menus()
	{
		return $this->belongsToMany(\App\Models\Menu::class);
	}

	public function options()
	{
		return $this->hasMany(\App\Models\Option::class);
	}

	public function variations()
	{
		return $this->hasMany(\App\Models\Variation::class);
	}
}
