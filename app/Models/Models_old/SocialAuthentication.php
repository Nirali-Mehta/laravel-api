<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 26 May 2019 19:24:26 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class SocialAuthentication
 * 
 * @property int $id
 * @property int $user_id
 * @property string $provider
 * @property string $access_token
 * @property string $profile_image
 * @property string $cover_image
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class SocialAuthentication extends Eloquent
{
	protected $casts = [
		'user_id' => 'int'
	];

	protected $hidden = [
		'access_token'
	];

	protected $fillable = [
		'user_id',
		'provider',
		'access_token',
		'profile_image',
		'cover_image'
	];
}
