<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 31 May 2019 12:53:39 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class ProductUnit
 * 
 * @property int $id
 * @property int $product_id
 * @property int $unit_id
 * @property bool $is_default_selected
 * @property bool $is_base_unit
 * @property array $meta
 * 
 * @property \App\Models\Product $product
 * @property \App\Models\Unit $unit
 *
 * @package App\Models
 */
class ProductUnit extends Eloquent
{
	public $incrementing = false;
	public $timestamps = false;
	
	protected $casts = [
		'product_id' => 'int',
		'unit_id' => 'int',
		'is_default_selected' => 'bool',
		'is_base_unit' => 'bool',
		'meta' => 'json'
	];

	protected $fillable = [
		'product_id',
		'unit_id',
		'is_default_selected',
		'is_base_unit',
		'meta'
	];

	public function product()
	{
		return $this->belongsTo(\App\Models\Product::class);
	}

	public function unit()
	{
		return $this->belongsTo(\App\Models\Unit::class);
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
