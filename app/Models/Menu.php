<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 31 May 2019 12:53:39 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Cviebrock\EloquentSluggable\Sluggable;

/**
 * Class Menu
 * 
 * @property int $id
 * @property int $branch_id
 * @property string $name
 * @property string $slug
 * @property bool $is_active
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $created_at
 * @property string $deleted_at
 * 
 * @property \App\Models\Branch $branch
 * @property \Illuminate\Database\Eloquent\Collection $counters
 * @property \Illuminate\Database\Eloquent\Collection $products
 *
 * @package App\Models
 */
class Menu extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
	
	protected $casts = [
		'branch_id' => 'int',
		'is_active' => 'bool'
	];

	protected $fillable = [
		'branch_id',
		'name',
		'slug',
		'is_active'
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
    
	public function branch()
	{
		return $this->belongsTo(\App\Models\Branch::class);
	}

	public function counters()
	{
		return $this->hasMany(\App\Models\Counter::class);
	}

	public function products()
	{
		return $this->belongsToMany(\App\Models\Product::class, 'menu_has_products')
					->withPivot('id', 'sale_price', 'is_in_stock', 'meta', 'deleted_at')
					->withTimestamps();
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
