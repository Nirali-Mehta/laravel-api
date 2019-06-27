<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 31 May 2019 12:53:39 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Cviebrock\EloquentSluggable\Sluggable;


/**
 * Class Company
 * 
 * @property int $id
 * @property int $company_type_id
 * @property string $name
 * @property string $slug
 * @property string $about
 * @property boolean $profile_image
 * @property boolean $cover_image
 * @property array $meta
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $created_at
 * @property string $deleted_at
 * 
 * @property \App\Models\CompanyType $company_type
 * @property \Illuminate\Database\Eloquent\Collection $branches
 * @property \Illuminate\Database\Eloquent\Collection $categories
 * @property \Illuminate\Database\Eloquent\Collection $units
 * @property \Illuminate\Database\Eloquent\Collection $variations
 *
 * @package App\Models
 */
class Company extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;
	protected $casts = [
		'company_type_id' => 'int',
		'profile_image' => 'boolean',
		'cover_image' => 'boolean',
		'meta' => 'json'
	];

	protected $fillable = [
		'company_type_id',
		'name',
		'slug',
		'about',
		'profile_image',
		'cover_image',
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
	public function company_type()
	{
		return $this->belongsTo(\App\Models\CompanyType::class);
	}

	public function branches()
	{
		return $this->hasMany(\App\Models\Branch::class);
	}

	public function categories()
	{
		return $this->hasMany(\App\Models\Category::class);
	}

	public function units()
	{
		return $this->hasMany(\App\Models\Unit::class);
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
