<?php

namespace App\Api\V1\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UnitResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return ['company_id' => $this->country_id,
        'name' => $this->name,
        'sub_unit_id' => $this->sub_unit_id,
        'sub_unit_value' => $this->sub_unit_value,
        'short_code' => $this->short_code,

        'company'=> new CompanyResource($this->whenLoaded('company')),

    ];
    }
}

