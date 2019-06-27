<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 31 May 2019 12:53:39 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Cviebrock\EloquentSluggable\Sluggable;

/**
 * Class Product
 * 
 * @property int $id
 * @property int $category_id
 * @property int $dietary_preference_id
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property string $profile_image
 * @property string $cover_image
 * @property string $hsn_code
 * @property bool $is_weighted_varianted
 * @property array $meta
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $created_at
 * @property string $deleted_at
 * 
 * @property \App\Models\Category $category
 * @property \App\Models\DietaryPreference $dietary_preference
 * @property \Illuminate\Database\Eloquent\Collection $menus
 * @property \Illuminate\Database\Eloquent\Collection $product_has_addons
 * @property \Illuminate\Database\Eloquent\Collection $units
 * @property \Illuminate\Database\Eloquent\Collection $variations
 *
 * @package App\Models
 */
class Product extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
	
	protected $casts = [
		'category_id' => 'int',
		'dietary_preference_id' => 'int',
		'is_weighted_varianted' => 'bool',
		'meta' => 'json'
	];

	protected $fillable = [
		'category_id',
		'dietary_preference_id',
		'title',
		'slug',
		'description',
		'profile_image',
		'cover_image',
		'hsn_code',
		'is_weighted_varianted',
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
                'source' => 'title'
            ]
        ];
	}

	public function category()
	{
		return $this->belongsTo(\App\Models\Category::class);
	}

	public function dietary_preference()
	{
		return $this->belongsTo(\App\Models\DietaryPreference::class);
	}

	public function menus()
	{
		return $this->belongsToMany(\App\Models\Menu::class, 'menu_has_products')
					->withPivot('id', 'sale_price', 'is_in_stock', 'meta', 'deleted_at')
					->withTimestamps();
	}

	public function product_has_addons()
	{
		return $this->hasMany(\App\Models\ProductHasAddon::class);
	}

	public function units()
	{
		return $this->belongsToMany(\App\Models\Unit::class, 'product_units')
					->withPivot('is_default_selected', 'is_base_unit', 'meta');
	}

	public function variations()
	{
		return $this->hasMany(\App\Models\Variation::class);
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
