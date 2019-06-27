<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 26 May 2019 19:24:26 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class Option
 * 
 * @property int $id
 * @property int $product_id
 * @property string $title
 * @property string $slung
 * @property string $description
 * @property bool $is_default_selected
 * @property int $additional_cost
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Product $product
 *
 * @package App\Models
 */
class Option extends Eloquent
{
	protected $casts = [
		'product_id' => 'int',
		'is_default_selected' => 'bool',
		'additional_cost' => 'int'
	];

	protected $fillable = [
		'product_id',
		'title',
		'slung',
		'description',
		'is_default_selected',
		'additional_cost'
	];

	public function product()
	{
		return $this->belongsTo(\App\Models\Product::class);
	}
}
