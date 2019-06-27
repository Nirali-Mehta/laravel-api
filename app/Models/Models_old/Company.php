<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 26 May 2019 19:24:26 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class Company
 * 
 * @property int $id
 * @property int $company_type_id
 * @property string $name
 * @property string $slug
 * @property string $about
 * @property string $profile_image
 * @property string $cover_image
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\CompanyType $company_type
 * @property \Illuminate\Database\Eloquent\Collection $branches
 *
 * @package App\Models
 */
class Company extends Eloquent
{
	protected $casts = [
		'company_type_id' => 'int'
	];

	protected $fillable = [
		'company_type_id',
		'name',
		'slug',
		'about',
		'profile_image',
		'cover_image'
	];

	public function company_type()
	{
		return $this->belongsTo(\App\Models\CompanyType::class);
	}

	public function branches()
	{
		return $this->hasMany(\App\Models\Branch::class);
	}
}
