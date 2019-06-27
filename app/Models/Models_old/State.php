<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 26 May 2019 19:24:26 +0000.
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
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Country $country
 * @property \Illuminate\Database\Eloquent\Collection $branches
 * @property \Illuminate\Database\Eloquent\Collection $cities
 *
 * @package App\Models
 */
class State extends Eloquent
{
	protected $casts = [
		'country_id' => 'int'
	];

	protected $fillable = [
		'country_id',
		'name',
		'short_code'
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
}
