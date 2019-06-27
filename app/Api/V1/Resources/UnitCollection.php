<?php

namespace App\Api\V1\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UnitCollection extends ResourceCollection
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
            'data' =>UnitResource::collection($this->collection),
            'links' => [
                'self' => 'link-value',
            ],
        ];    }
}
