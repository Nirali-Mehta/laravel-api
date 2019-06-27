<?php

namespace App\Api\V1\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return ['company_type_id' => $this->company_type_id,
        'name' => $this->name,
        'slug' => $this->slug,
        'about' => $this->about,
        'profile_image' => $this->profile_image,
        'cover_image' => $this->cover_image,
        'meta' => $this->meta,

        'company_type'=> new CompanyTypeResource($this->whenLoaded('company_type')),

    ];
    }
}
