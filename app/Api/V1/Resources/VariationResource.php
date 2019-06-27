<?php

namespace App\Api\V1\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VariationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return ['company_id' => $this->company_id,
        'sub_variation_id' => $this->sub_variation_id,
        'title' => $this->title,
        'product_id' => $this->product_id,
        'slug' => $this->slug,
        'description' => $this->description,
        'is_multi_selected' => $this->is_multi_selected,
        'is_default_selected' => $this->is_default_selected,
        'meta' => $this->meta,
    
        'company'=> new CompanyResource($this->whenLoaded('company')),
        'product'=> new ProductResource($this->whenLoaded('product')),
    ];
    }
}


