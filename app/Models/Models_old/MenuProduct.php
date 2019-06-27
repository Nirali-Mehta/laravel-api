<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 26 May 2019 19:24:26 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class MenuProduct
 * 
 * @property int $menu_id
 * @property int $product_id
 * 
 * @property \App\Models\Menu $menu
 * @property \App\Models\Product $product
 *
 * @package App\Models
 */
class MenuProduct extends Eloquent
{
	protected $table = 'menu_product';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'menu_id' => 'int',
		'product_id' => 'int'
	];

	protected $fillable = [
		'menu_id',
		'product_id'
	];

	public function menu()
	{
		return $this->belongsTo(\App\Models\Menu::class);
	}

	public function product()
	{
		return $this->belongsTo(\App\Models\Product::class);
	}
}
