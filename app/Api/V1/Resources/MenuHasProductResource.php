<?php

namespace App\Api\V1\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MenuHasProductResource extends JsonResource
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
            'menu_id' => $this->menu_id,
            'product_id' => $this->product_id,
            'sale_price' => $this->sale_price,
            'is_in_stock' => $this->is_in_stock,
            'meta' => $this->meta,

            'menu'=> new MenuResource($this->whenLoaded('Menu')),
            'product'=> new ProductResource($this->whenLoaded('Product')),
        ];
    }
}

