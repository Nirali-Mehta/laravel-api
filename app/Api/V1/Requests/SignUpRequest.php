<?php

namespace App\Api\V1\Requests;

use Config;
use Dingo\Api\Http\FormRequest;

class SignUpRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users|max:255',
            'mobile' => 'unique:users|max:20',
            'password' => 'required|min:6',
            'location_id' => 'exists:locations,id',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }

    public function authorize()
    {
        return true;
    }
}
