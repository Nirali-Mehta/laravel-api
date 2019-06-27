<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 31 May 2019 12:53:39 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Cviebrock\EloquentSluggable\Sluggable;

/**
 * Class Selection
 * 
 * @property int $id
 * @property string $variation_id
 * @property int $menu_has_product_id
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property bool $is_default_selected
 * @property bool $is_weight_verianted
 * @property bool $have_relations
 * @property array $meta
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $created_at
 * 
 * @property \App\Models\MenuHasProduct $menu_has_product
 *
 * @package App\Models
 */
class Selection extends Eloquent
{
    
	protected $casts = [
		'menu_has_product_id' => 'int',
		'is_default_selected' => 'bool',
		'is_weight_verianted' => 'bool',
		'have_relations' => 'bool',
		'meta' => 'json'
	];

	protected $fillable = [
		'variation_id',
		'menu_has_product_id',
		'title',
		'slug',
		'description',
		'is_default_selected',
		'is_weight_verianted',
		'have_relations',
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
    
	public function menu_has_product()
	{
		return $this->belongsTo(\App\Models\MenuHasProduct::class);
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
