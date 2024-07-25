<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StoreResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                     => $this->id,
            'user_id'                => $this->id,
            'name'                   => $this->name,
            'address'                => $this->address,
            'city'                   => $this->city,
            'state'                  => $this->state,
            'country'                => $this->country,
            'zip'                    => $this->zip,
            'phone'                  => $this->phone,
            'currency'               => $this->currency,
            'multi_location_enabled' => $this->multi_location_enabled,
        ];
    }
}

        
     
        
       