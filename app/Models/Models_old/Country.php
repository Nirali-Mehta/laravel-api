<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 26 May 2019 19:24:26 +0000.
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
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Currency $currency
 * @property \Illuminate\Database\Eloquent\Collection $branches
 * @property \Illuminate\Database\Eloquent\Collection $states
 *
 * @package App\Models
 */
class Country extends Eloquent
{
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
}
