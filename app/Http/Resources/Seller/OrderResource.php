<?php

namespace App\Http\Resources\Seller;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            "buyer" => new UserResource($this->user),
            "product" => new ProductResource($this->product),
            "offer_price" => $this->offer_price,
            "status" => $this->status,
            "arrive" => $this->arrive  == "1" ? true : false,
            "completed" => $this->completed  == "1" ? true : false,
            "updated_at" => Carbon::parse($this->updated_at)->format('Y m d, H:i')
        ];
    }
}
