<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 31 May 2019 12:53:39 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Cviebrock\EloquentSluggable\Sluggable;

/**
 * Class Branch
 * 
 * @property int $id
 * @property int $branch_type_id
 * @property int $company_id
 * @property string $name
 * @property string $slug
 * @property string $email
 * @property string $mobile
 * @property string $about
 * @property array $settings
 * @property string $profile_image
 * @property string $cover_image
 * @property string $tin_number
 * @property string $pan_number
 * @property string $website
 * @property string $timezone
 * @property string $address
 * @property string $postal_code
 * @property int $country_id
 * @property int $state_id
 * @property int $city_id
 * @property float $latitude
 * @property float $longitude
 * @property array $meta
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $created_at
 * @property string $deleted_at
 * 
 * @property \App\Models\BranchType $branch_type
 * @property \App\Models\Company $company
 * @property \App\Models\Country $country
 * @property \App\Models\State $state
 * @property \App\Models\City $city
 * @property \Illuminate\Database\Eloquent\Collection $counters
 * @property \Illuminate\Database\Eloquent\Collection $menus
 *
 * @package App\Models
 */
class Branch extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $casts = [
		'branch_type_id' => 'int',
		'company_id' => 'int',
		'settings' => 'json',
		'country_id' => 'int',
		'state_id' => 'int',
		'city_id' => 'int',
		'latitude' => 'float',
		'longitude' => 'float',
		'meta' => 'json'
	];

	protected $fillable = [
		'branch_type_id',
		'company_id',
		'name',
		'slug',
		'email',
		'mobile',
		'about',
		'settings',
		'profile_image',
		'cover_image',
		'tin_number',
		'pan_number',
		'website',
		'timezone',
		'address',
		'postal_code',
		'country_id',
		'state_id',
		'city_id',
		'latitude',
		'longitude',
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

	public function branch_type()
	{
		return $this->belongsTo(\App\Models\BranchType::class);
	}

	public function company()
	{
		return $this->belongsTo(\App\Models\Company::class);
	}

	public function country()
	{
		return $this->belongsTo(\App\Models\Country::class);
	}

	public function state()
	{
		return $this->belongsTo(\App\Models\State::class);
	}

	public function city()
	{
		return $this->belongsTo(\App\Models\City::class);
	}

	public function counters()
	{
		return $this->hasMany(\App\Models\Counter::class);
	}

	public function menus()
	{
		return $this->hasMany(\App\Models\Menu::class);
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

    public function findWhere($json, $list = ['*'])
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
