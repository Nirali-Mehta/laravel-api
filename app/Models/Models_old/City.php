<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 26 May 2019 19:24:26 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class City
 * 
 * @property int $id
 * @property int $state_id
 * @property string $name
 * @property string $short_code
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\State $state
 * @property \Illuminate\Database\Eloquent\Collection $branches
 *
 * @package App\Models
 */
class City extends Eloquent
{
	protected $casts = [
		'state_id' => 'int'
	];

	protected $fillable = [
		'state_id',
		'name',
		'short_code'
	];

	public function state()
	{
		return $this->belongsTo(\App\Models\State::class);
	}

	public function branches()
	{
		return $this->hasMany(\App\Models\Branch::class);
	}
}
