<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 26 May 2019 19:24:26 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class Currency
 * 
 * @property int $id
 * @property string $name
 * @property string $short_code
 * @property string $sign
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $countries
 *
 * @package App\Models
 */
class Currency extends Eloquent
{
	protected $fillable = [
		'name',
		'short_code',
		'sign'
	];

	public function countries()
	{
		return $this->hasMany(\App\Models\Country::class);
	}
}
