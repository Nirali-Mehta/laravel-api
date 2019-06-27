<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 31 May 2019 12:53:39 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class State
 *
 * @property int $id
 * @property int $country_id
 * @property string $name
 * @property string $short_code
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $created_at
 * @property string $deleted_at
 *
 * @property \App\Models\Country $country
 * @property \Illuminate\Database\Eloquent\Collection $branches
 * @property \Illuminate\Database\Eloquent\Collection $cities
 *
 * @package App\Models
 */

abstract class NestedClass extends \Eloquent {}

class State extends NestedClass
{
    use \Illuminate\Database\Eloquent\SoftDeletes;
	
    protected $casts = [
        'country_id' => 'int',
    ];

    protected $fillable = [
        'country_id',
        'name',
        'short_code',
    ];

    public function country()
    {
        return $this->belongsTo(\App\Models\Country::class);
    }

    public function branches()
    {
        return $this->hasMany(\App\Models\Branch::class);
    }

    public function cities()
    {
        return $this->hasMany(\App\Models\City::class);
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

    public function findWhere($json, $list="*")
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
