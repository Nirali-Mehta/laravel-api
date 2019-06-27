<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 31 May 2019 12:53:39 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class ProductHasAddon
 * 
 * @property int $id
 * @property int $product_id
 * @property float $sale_price
 * @property bool $is_in_stock
 * @property array $meta
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $created_at
 * @property string $deleted_at
 * 
 * @property \App\Models\Product $product
 *
 * @package App\Models
 */
class ProductHasAddon extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $casts = [
		'product_id' => 'int',
		'sale_price' => 'float',
		'is_in_stock' => 'bool',
		'meta' => 'json'
	];

	protected $fillable = [
		'product_id',
		'sale_price',
		'is_in_stock',
		'meta'
	];

	public function product()
	{
		return $this->belongsTo(\App\Models\Product::class);
	}


    #update
    public function nestedDataDisplay($nestedList)
    {
        return $this->with($nestedList)->get()->toArray();
    }
    public function dataDisplay($list)
    {
        return $this->with($list)->get()->toArray();
    }

    public function findWhere($json, $list)
    {
        $i = 0;
        $str = "";
        foreach ($json as $key => $value) {
            $arr[] = array($key, $value);
        }
        if (!$list) {
            $list = $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
            $data = $this->select($list)->where($arr)->get();
            return ($data);
        } else {
            $data = $this->select($list)->where($arr)->get();
            return ($data);
        }
    }

}
