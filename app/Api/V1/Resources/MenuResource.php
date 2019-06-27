<?php

namespace App\Api\V1\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MenuResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return ['branch_id' => $this->branch_id,
        'name' => $this->name,
        'slug' => $this->slug,
        'is_active' => $this->is_active,

        'branch'=> new BranchResource($this->whenLoaded('branch')),
    ];
    }
}

