<?php

namespace App\Http\Controllers\v1\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Seller\FruitResource;
use App\Product;
use App\Response;

class FruitController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function fetchFruitBySubDistrict($sub_district_id)
    {
        $products = Product::where('sub_district_id', $sub_district_id)->get();

        $res = [];
        foreach ($products as $product) {
            array_push($res, $product->fruit);
        }

        return Response::transform('success', true, FruitResource::collection(collect($res)));
    }
}
