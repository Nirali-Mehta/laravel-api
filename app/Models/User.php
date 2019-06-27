<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 31 May 2019 12:53:39 +0000.
 */

namespace App\Models;

use Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Cviebrock\EloquentSluggable\Sluggable;
use Spatie\Permission\Traits\HasRoles;
use App\Traits\ImageTrait;
use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class User
 * 
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $password
 * @property string $mobile
 * @property string $email
 * @property \Carbon\Carbon $email_verified_at
 * @property bool $is_mobile_valid
 * @property bool $is_email_valid
 * @property boolean $profile_image
 * @property boolean $cover_image
 * @property string $remember_token
 * @property int $referrer_id
 * @property string $referrer_type
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $created_at
 * @property string $deleted_at
 *
 * @package App\Models
 */
class User extends Authenticatable implements JWTSubject
{
	use \Illuminate\Database\Eloquent\SoftDeletes;

	use HasRoles;

	protected $guard_name = 'web'; // or whatever guard you want to use
	
	use Notifiable, Sluggable, HasRoles, ImageTrait;

    public $fileFields = ['image' => []];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

	protected $casts = [
		'is_mobile_valid' => 'bool',
		'is_email_valid' => 'bool',
		'profile_image' => 'boolean',
		'cover_image' => 'boolean',
		'referrer_id' => 'int'
	];

	protected $dates = [
		'email_verified_at'
	];

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'name',
		'slug',
		'password',
		'mobile',
		'email',
		'email_verified_at',
		'is_mobile_valid',
		'is_email_valid',
		'profile_image',
		'cover_image',
		'remember_token',
		'referrer_id',
		'referrer_type'
	];

	public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function socialAuthentications()
    {
        return $this->hasMany(SocialAuthentication::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

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
