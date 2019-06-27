<?php

namespace App\Api\V1\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SelectionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return ['variation_id' => $this->variation_id,
        'menu_has_product_id' => $this->menu_has_product_id,
        'title' => $this->title,
        'slug' => $this->slug,
        'description' => $this->description,
        'is_default_selected' => $this->is_default_selected,
        'is_weight_verianted' => $this->is_weight_verianted,
        'have_relations' => $this->have_relations,
        'meta' => $this->meta,

        'variation'=> new VariationResource($this->whenLoaded('variation')),
        'menuhasproduct'=> new MenuHasProductResource($this->whenLoaded('menuhasproduct')),

    ];
    }
}
