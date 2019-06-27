<?php

namespace App\Api\V1\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'slug' => $this->slug,
            'mobile' => $this->mobile,
            'email' => $this->email,
            'referrer_id' => $this->referrer_id,
            'referrer_type' => $this->referrer_type,
            ];
    }
}
