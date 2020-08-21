<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function seller()
    {
        return $this->belongsTo(Seller::class, 'seller_id', 'id');
    }

    public function order()
    {
        return $this->hasOne(Order::class, 'product_id', 'id');
    }

    public function subDistrict()
    {
        return $this->belongsTo(SubDistrict::class, 'sub_district_id', 'id');
    }

    public function fruit()
    {
        return $this->belongsTo(Fruit::class, 'fruit_id', 'id');
    }

}
