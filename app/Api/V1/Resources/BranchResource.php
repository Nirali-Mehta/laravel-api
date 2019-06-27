<?php

namespace App\Api\V1\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BranchResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return ['id' => $this->id,
        'name' => $this->name,
        'email' => $this->email,
        'branch_type_id'=> $this->branch_type_id,
		'company_id'=>$this->company_id,
		'slug'=>$this->slug,
		'mobile'=>$this->mobile,
		'about'=>$this->about,
		'settings'=>$this->settings,
		'profile_image'=>$this->profile_image,
		'cover_image'=>$this->cover_image,
		'tin_number'=>$this->tin_number,
		'country_id'=>$this->country_id,
		'state_id'=>$this->state_id,
        'city_id'=>$this->city_id,
        
        'country'=> new CountryResource($this->whenLoaded('country')),
        'state'=> new StateResource($this->whenLoaded('state')),
        'city'=> new CityResource($this->whenLoaded('city')),
        'branch_type'=> new BranchTypeResource($this->whenLoaded('branch_type')),
        'company'=> new CompanyResource($this->whenLoaded('company')),
    ];
    }
}
