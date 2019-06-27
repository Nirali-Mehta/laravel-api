<?php

namespace App\Api\V1\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductHasAddonResource extends JsonResource
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
        'sale_price' => $this->sale_price,
        'is_in_stock' => $this->is_in_stock,
        'meta' => $this->meta,
    
        'product'=> new ProductResource($this->whenLoaded('product')),
    ];
    }
}

