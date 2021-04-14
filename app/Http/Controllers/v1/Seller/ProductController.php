<?php

namespace App\Http\Controllers\v1\Seller;

use App\Order;
use App\Product;
use Carbon\Carbon;
use App\ProductImage;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Seller\ProductResource;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:seller-api');
    }

    public function find($id)
    {
        $product = Product::findOrFail($id);
        return response()->json([
            'message' => 'success',
            'status' => true,
            'data' => new ProductResource($product),
        ]);
    }

    public function show()
    {
        try {
            $products = Product::where('seller_id', Auth::guard('seller-api')->user()->id)->get();
            $results = [];
            foreach ($products as $product){
                if (!$product->order || $product->order['status'] != '2') {
                    array_push($results, $product);
                }
            }

            $this->checkFakeOrder();

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

    public function checkFakeOrder()
    {
        $orders = Order::where('seller_id', Auth::guard('seller-api')->user()->id)
        ->where('status', '2')
        ->where('arrive', false)->get();

        foreach ($orders as $order) {
            $diffCarbon = Carbon::now()->diff($order->created_at);
            if ($diffCarbon->d > 0) {
                $order->delete();
            }
        }
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'price' => 'required|numeric',
            ]);

            if ($validator->fails()) {
                return response()->json(['message' => $validator->errors(), 'status' => false, 'data' => (object)[]]);
            }

            $product = Product::create([
                'seller_id' => Auth::user()->id,
                'fruit_id' => $request->fruit_id,
                'sub_district_id' => $request->sub_district_id,
                'address' => $request->address,
                'description' => $request->description,
                'price' => $request->price,
                "latitude" => $request->lat,
                "longitude" => $request->lng,
                'status' => true
            ]);

            $images = $request->images;
            foreach ($images as $key => $image){
                $uploadFile = Helper::uploadFile($image);
                // $filename = time() . $key . '.' . $image->getClientOriginalExtension();

                // $filepath = 'product/' . $filename;
                // Storage::disk('s3')->put($filepath, file_get_contents($image));

                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $uploadFile,
                ]);
            }
            DB::commit();
            return response()->json([
                'message' => 'success',
                'status' => true,
                'data' => (object)[]
            ]);

        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json([
                'message' => $exception->getMessage(),
                'status' => false,
                'data' => (object)[],
            ]);
        }
    }

    public function update($id, Request $request)
    {
        try {
            $data = Product::findOrFail($id);
            $data->seller_id = Auth::user()->id;
            $data->fruit_id = $request->fruit_id ?? $data->fruit_id;
            $data->sub_district_id = $request->sub_district_id ?? $data->sub_district_id;
            $data->address = $request->address;
            $data->description = $request->description;
            $data->price = $request->price;
            $data->latitude = $request->lat ?? $data->latitude;
            $data->longitude = $request->lng ?? $data->longitude;
            $data->update();

            return response()->json([
                'message' => 'success update product',
                'status' => true,
                'data' => (object)[]
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
                'status' => false,
                'data' => (object)[],
            ]);
        }
    }

    public function updatePhoto(Request $request, $id)
    {
        foreach ($request->images as $image) {
            $uploadFile = Helper::uploadFile($image);
            // $filename = time() . '.' . $image->getClientOriginalExtension();
            // $filepath = 'product/' . $filename;
            // Storage::disk('s3')->put($filepath, file_get_contents($image));

            ProductImage::where('product_id', $id)->update([
                //'image' => Storage::disk('s3')->url($filepath, $filename)
                'image' => $uploadFile
            ]);
        }

        return response()->json([
            'message' => 'success update product',
            'status' => true,
            'data' =>(object)[]
        ]);
    }

    public function delete ($id){
        $data = Product::find($id);
        $data->delete();
        return response()->json([
            'message' => "berhasil menghapus product",
            'status' => true,
            'data' => (object)[],
        ]);
    }
}
