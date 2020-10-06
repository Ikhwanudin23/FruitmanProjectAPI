<?php

namespace App\Http\Controllers\v1\User;

use App\Http\Resources\User\ProductResource;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Response;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::where('status', true)->get();
            $results = [];
            foreach ($products as $product) {
                if (!$product->order || $product->order['status'] != '2') {
                    array_push($results, $product);
                }
            }

        return Response::transform('succes', true, ProductResource::collection(collect($results)));
    }

    public function fetchProductBySubDistrict($sub_district_id)
    {
        $products = Product::where('status', true)
        ->where('sub_district_id', $sub_district_id)->get();
            $results = [];
            foreach ($products as $product) {
                if (!$product->order || $product->order['status'] != '2') {
                    array_push($results, $product);
                }
            }

        return Response::transform('succes', true, ProductResource::collection(collect($results)));
    }

    public function allByCriteria(Request $request)
    {
        try {
            $sub_district_id = $request->sub_district_id;
            $fruit_id = $request->fruit_id;
            $products = Product::where('status', true)
            ->where('sub_district_id', $sub_district_id)
            ->where('fruit_id', $fruit_id)->get();
            $results = [];
            foreach ($products as $product) {
                if (!$product->order || $product->order['status'] != '2') {
                    array_push($results, $product);
                }
            }
            return Response::transform('succes', true, ProductResource::collection(collect($results)));

        } catch (\Exception $exception) {
            return Response::transform($exception->getMessage(), false, (object)[]);
        }
    }

    public function search($name)
    {
        $ucwords = ucwords($name);
        $products = Product::query()
            ->where('name', 'LIKE', "%{$ucwords}%")
            ->where('status', true)->get();

        return response()->json([
            'message' => 'Successfully search product by name',
            'status' => true,
            'data' => ProductResource::collection($products)
        ]);
    }
}
