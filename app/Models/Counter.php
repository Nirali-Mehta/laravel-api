<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 31 May 2019 12:53:39 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Cviebrock\EloquentSluggable\Sluggable;

/**
 * Class Counter
 * 
 * @property int $id
 * @property int $branch_id
 * @property int $menu_id
 * @property string $name
 * @property string $slug
 * @property string $about
 * @property array $settings
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $created_at
 * 
 * @property \App\Models\Branch $branch
 * @property \App\Models\Menu $menu
 *
 * @package App\Models
 */
class Counter extends Eloquent
{	

	protected $casts = [
		'branch_id' => 'int',
		'menu_id' => 'int',
		'settings' => 'json'
	];

	protected $fillable = [
		'branch_id',
		'menu_id',
		'name',
		'slug',
		'about',
		'settings'
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

	public function menu()
	{
		return $this->belongsTo(\App\Models\Menu::class);
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
