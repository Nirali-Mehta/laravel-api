<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 31 May 2019 12:53:39 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Cviebrock\EloquentSluggable\Sluggable;

/**
 * Class Unit
 * 
 * @property int $id
 * @property int $company_id
 * @property int $sub_unit_id
 * @property float $sub_unit_value
 * @property string $name
 * @property string $slug
 * @property string $short_code
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $created_at
 * @property string $deleted_at
 * 
 * @property \App\Models\Company $company
 * @property \App\Models\Unit $unit
 * @property \Illuminate\Database\Eloquent\Collection $products
 * @property \Illuminate\Database\Eloquent\Collection $units
 *
 * @package App\Models
 */
class Unit extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
	
	protected $casts = [
		'company_id' => 'int',
		'sub_unit_id' => 'int',
		'sub_unit_value' => 'float'
	];

	protected $fillable = [
		'company_id',
		'sub_unit_id',
		'sub_unit_value',
		'name',
		'slug',
		'short_code'
	];
	use Sluggable;
	/**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
	}

	public function company()
	{
		return $this->belongsTo(\App\Models\Company::class);
	}

	public function unit()
	{
		return $this->belongsTo(\App\Models\Unit::class, 'sub_unit_id');
	}

	public function products()
	{
		return $this->belongsToMany(\App\Models\Product::class, 'product_units')
					->withPivot('is_default_selected', 'is_base_unit', 'meta');
	}

	public function units()
	{
		return $this->hasMany(\App\Models\Unit::class, 'sub_unit_id');
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
