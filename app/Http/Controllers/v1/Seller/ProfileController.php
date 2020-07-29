<?php

namespace App\Http\Controllers\v1\Seller;

use App\Http\Resources\User\SellerResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:seller-api');
    }

    public function profile()
    {
        $user = Auth::guard('seller-api')->user();

        return response()->json([
            'message' => 'successfully get profile',
            'status' => true,
            'data' => new SellerResource($user)
        ]);
    }

    public function updatePhoto(Request $request)
    {
        $photo = $request->file('image');
        $filename = time() . '.' . $photo->getClientOriginalExtension();
        $filepath = 'product/' . $filename;
        Storage::disk('s3')->put($filepath, file_get_contents($photo));

        $user = Auth::guard('seller-api')->user();
        $user->image = Storage::disk('s3')->url($filepath, $filename);
        $user->save();

        return response()->json([
            'message' => 'successfully update profile',
            'status' => true,
            'data' => $user
        ]);
    }

    public function updateProfile(Request $request)
    {
        if ($request->password == null || empty($request->password)){
            $user = Auth::guard('seller-api')->user();
            $user->name = $request->name;
            $user->address = $request->address;
            $user->phone = $request->phone;
            $user->save();
            return response()->json([
                'message' => 'successfully update profile',
                'status' => true,
                'data' => $user
            ]);
        }else{
            $user = Auth::guard('seller-api')->user();
            $user->name = $request->name;
            $user->address = $request->address;
            $user->password = $request->password;
            $user->phone = $request->phone;
            $user->save();
            return response()->json([
                'message' => 'successfully update profile',
                'status' => true,
                'data' => $user
            ]);
        }
    }
}
