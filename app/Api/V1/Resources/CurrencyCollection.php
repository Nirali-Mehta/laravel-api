<?php

namespace App\Api\V1\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CurrencyCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => CurrencyResource::collection($this->collection),
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
