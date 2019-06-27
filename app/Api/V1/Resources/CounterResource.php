<?php

namespace App\Api\V1\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CounterResource extends JsonResource
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
        'menu_id' => $this->menu_id,
        'name' => $this->name,
        'slug' => $this->slug,
        'about' => $this->about,
        'settings' => $this->settings,

        'branch'=> new BranchResource($this->whenLoaded('branch')),
        'menu'=> new MenuResource($this->whenLoaded('menu')),

        ];
    }
}
