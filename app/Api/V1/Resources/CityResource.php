<?php

namespace App\Api\V1\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CityResource extends JsonResource
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
            'state_id' => $this->state_id,
            'name' => $this->name,
            'short_code' => $this->short_code,
        
            'state'=> new StateResource($this->whenLoaded('state')),

        ];
    }
}
