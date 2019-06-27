<?php

namespace App\Api\V1\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductUnitResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return ['product_id' => $this->product_id,
        'unit_id' => $this->unit_id,
        'is_default_selected' => $this->is_default_selected,
        'is_base_unit' => $this->is_base_unit,
        'meta' => $this->meta,
    
        'product'=> new ProductResource($this->whenLoaded('product')),
        'unit'=> new UnitResource($this->whenLoaded('unit')),
    ];
    }
}

