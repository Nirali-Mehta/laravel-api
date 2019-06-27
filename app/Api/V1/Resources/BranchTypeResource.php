<?php

namespace App\Api\V1\Resources;
use Illuminate\Http\Resources\Json\JsonResource;

class BranchTypeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return ['name' => $this->name,
		'slug'=>$this->slug];
    }
}
