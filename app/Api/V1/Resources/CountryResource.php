<?php

namespace App\Api\V1\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CountryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return ['currency_id' => $this->currency_id,
        'name' => $this->name,
        'short_code' => $this->short_code,
        'flag' => $this->flag,

        'currency' =>new CurrencyResource($this->whenLoaded('currency'))
    ];    
    }
}

