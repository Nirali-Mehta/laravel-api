<?php

namespace App\Api\V1\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return ['country_id' => $this->country_id,
        'name' => $this->name,
        'short_code' => $this->short_code,
    
        'country'=> new CountryResource($this->whenLoaded('country')),
    ];
    }
}

