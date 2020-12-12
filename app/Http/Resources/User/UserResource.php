<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        
        $premium = false;
        $overload = false;

        return [
            "id"        => $this->id,
            "name"      => $this->name,
            "email"     => $this->email,
            "image"     => $this->image,
            "address"   => $this->address,
            "phone"     => $this->phone,
            "api_token" => $this->api_token,                                                                                                                                                    
            "status"    => $this->status,
            "premium"   => $premium,
            "overload"   => $overload,
        ];
    }
}
