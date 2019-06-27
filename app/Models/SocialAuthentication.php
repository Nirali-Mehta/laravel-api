<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 31 May 2019 12:53:39 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class SocialAuthentication
 * 
 * @property int $id
 * @property int $user_id
 * @property string $provider
 * @property string $provider_id
 * @property string $access_token
 * @property string $profile_image
 * @property string $cover_image
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $created_at
 * @property string $deleted_at
 *
 * @package App\Models
 */
class SocialAuthentication extends Eloquent
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	protected $casts = [
		'user_id' => 'int'
	];

	protected $hidden = [
		'access_token'
	];

	protected $fillable = [
		'user_id',
		'provider',
		'provider_id',
		'access_token',
		'profile_image',
		'cover_image'
	];
}
