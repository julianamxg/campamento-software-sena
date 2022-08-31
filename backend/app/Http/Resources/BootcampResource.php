<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BootcampResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return[ 
                "name" =>$this->name,
                'description' =>$this->description,
                'website' =>$this->website, 
                'phone' =>$this->phone, 
                'user_id' =>$this->user_id, 
                'average_rating' =>$this->average_rating,
                'average_cost' =>$this->average_cost
            ];
    }
}
