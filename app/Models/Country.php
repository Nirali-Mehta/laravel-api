<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 31 May 2019 12:53:39 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class Country
 * 
 * @property int $id
 * @property int $currency_id
 * @property string $name
 * @property string $short_code
 * @property string $flag
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $created_at
 * @property string $deleted_at
 * 
 * @property \App\Models\Currency $currency
 * @property \Illuminate\Database\Eloquent\Collection $branches
 * @property \Illuminate\Database\Eloquent\Collection $states
 *
 * @package App\Models
 */

abstract class CustomClass extends \Eloquent {}

class Country extends CustomClass
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $casts = [
		'currency_id' => 'int'
	];

	protected $fillable = [
		'currency_id',
		'name',
		'short_code',
		'flag'
	];

	public function currency()
	{
		return $this->belongsTo(\App\Models\Currency::class);
	}

	public function branches()
	{
		return $this->hasMany(\App\Models\Branch::class);
	}

	public function states()
	{
		return $this->hasMany(\App\Models\State::class);
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
