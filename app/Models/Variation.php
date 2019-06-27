<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 31 May 2019 12:53:39 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Cviebrock\EloquentSluggable\Sluggable;

/**
 * Class Variation
 * 
 * @property int $id
 * @property int $company_id
 * @property int $sub_variation_id
 * @property string $title
 * @property int $product_id
 * @property string $slug
 * @property string $description
 * @property bool $is_multi_selected
 * @property bool $is_default_selected
 * @property array $meta
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $created_at
 * @property string $deleted_at
 * 
 * @property \App\Models\Product $product
 * @property \App\Models\Company $company
 *
 * @package App\Models
 */
class Variation extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $casts = [
		'company_id' => 'int',
		'sub_variation_id' => 'int',
		'product_id' => 'int',
		'is_multi_selected' => 'bool',
		'is_default_selected' => 'bool',
		'meta' => 'json'
	];

	protected $fillable = [
		'company_id',
		'sub_variation_id',
		'title',
		'product_id',
		'slug',
		'description',
		'is_multi_selected',
		'is_default_selected',
		'meta'
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
	public function product()
	{
		return $this->belongsTo(\App\Models\Product::class);
	}

	public function company()
	{
		return $this->belongsTo(\App\Models\Company::class);
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
