<?php

namespace App\Http\Controllers\v1\User;

use App\Http\Resources\User\ProductResource;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        try {

            $products = Product::where('status', true)->get();
            $results = [];
            foreach ($products as $product) {
                if (!$product->order || $product->order['status'] != '2') {
                    array_push($results, $product);
                }
            }


            return response()->json([
                'message' => 'success',
                'status' => true,
                'data' => ProductResource::collection(collect($results)),
            ]);

        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
                'status' => false,
                'data' => (object)[],
            ]);
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
