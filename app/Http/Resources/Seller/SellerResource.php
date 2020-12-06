<?php

namespace App\Http\Resources\Seller;

use Illuminate\Http\Resources\Json\JsonResource;

class SellerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $premium = $this->premium ? true : false;
        $overload = count($this->products) >= 2 ? true : false;

        return [
            "id"        => $this->id,
            "name"      => $this->name,
            "email"     => $this->email,
            "image"     => $this->image,
            "address"   => $this->address,
            "phone"     => $this->phone,
            "status"    => $this->status,
            "premium"   => $premium,
            "overload"  => $overload,
        ];
    }
}
