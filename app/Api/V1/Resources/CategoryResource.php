<?php

namespace App\Api\V1\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'parent_id' => $this->parent_id,
            'company_id' => $this->company_id,
            'name' => $this->name,
            'slug' => $this->slug,

            'company' => new CompanyResource($this->whenLoaded('company')),

        ];
    }
}
