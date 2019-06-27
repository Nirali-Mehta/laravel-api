<?php

namespace App\Api\V1\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return ['category_id' => $this->category_id,
        'dietary_preference_id' => $this->dietary_preference_id,
        'title' => $this->title,
        'slug' => $this->slug,
        'description' => $this->description,
        'profile_image' => $this->profile_image,
        'cover_image' => $this->cover_image,
        'hsn_code' => $this->hsn_code,
        'is_weighted_varianted' => $this->is_weighted_varianted,
        'meta' => $this->meta,

        'category'=> new CategoryResource($this->whenLoaded('category')),
        'dietarypreference'=> new DietaryPreferenceResource($this->whenLoaded('dietarypreference')),
    ];
    }
}

