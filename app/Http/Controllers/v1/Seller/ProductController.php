<?php

namespace App\Http\Controllers\v1\Seller;

use App\Http\Resources\Seller\ProductResource;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:seller-api');
    }

    public function show()
    {
        try {
            $fruits = Product::where('seller_id', Auth::user()->id)->get();

            return response()->json([
                'message' => 'success',
                'status' => true,
                'data' => ProductResource::collection(collect($fruits)),
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
                'status' => false,
                'data' => (object)[],
            ]);
        }
    }

    public function store(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'price' => 'required|numeric',
            ]);

            if ($validator->fails()) {
                return response()->json(['message' => $validator->errors(), 'status' => false, 'data' => (object)[]]);
            }

            $photo = $request->file('image');
            $filename = time() . '.' . $photo->getClientOriginalExtension();
            $filepath = 'product/' . $filename;
            Storage::disk('s3')->put($filepath, file_get_contents($photo));

            $product = Product::create([
                'seller_id' => Auth::user()->id,
                
                'fruit_id' => $request->fruit_id,
                'sub_district_id' => $request->sub_district_id,
                'address' => $request->address,
                'description' => $request->description,
                'price' => $request->price,
                'image' =>  Storage::disk('s3')->url($filepath, $filename),
                "latitude" => $request->lat,
                "longitude" => $request->lng,
                'status' => true
            ]);

            return response()->json([
                'message' => 'success',
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

    public function update($id, Request $request)
    {
        try {
            $data = Product::findOrFail($id);
            $data->seller_id = Auth::user()->id;
            $data->fruit_id = $request->fruit_id;
            $data->sub_district_id = $request->sub_district_id;
            $data->address = $request->address;
            $data->description = $request->description;
            $data->price = $request->price;
            $data->latitude = $request->lat;
            $data->longitude = $request->lng;
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
        $photo = $request->file('image');
        $filename = time() . '.' . $photo->getClientOriginalExtension();
        $filepath = 'product/' . $filename;
        Storage::disk('s3')->put($filepath, file_get_contents($photo));

        $product = Product::findOrFail($id);
        $product->image = Storage::disk('s3')->url($filepath, $filename);
        $product->update();

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
