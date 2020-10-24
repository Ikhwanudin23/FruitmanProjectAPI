<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "name" => $this->fruit->name,
            "description" => $this->description,
            //"image" => $this->image,
            "address" => $this->address,
            "price" => $this->price,
            "status" => $this->status,
            "latitude" => $this->latitude,
            "longitude" => $this->longitude,
            "seller" => new SellerResource($this->seller),
            "fruit" => new FruitResource($this->fruit),
            "sub_district" => new SubDistrictResource($this->subDistrict),
            "images" => $this->images,
        ];
    }
}
