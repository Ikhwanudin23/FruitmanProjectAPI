<?php

namespace App\Http\Controllers\v1\Seller;

use App\Admin;
use App\Helper;
use App\Premium;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\User\SellerResource;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:seller-api');
    }

    public function premium(Request $request)
    {
        $user = Auth::guard('seller-api')->user();
        $photo = $request->file('image');
        $filename = time().'-'.$user->name. '.' . $photo->getClientOriginalExtension();
        $filepath = 'premium/' . $filename;
        Storage::disk('s3')->put($filepath, file_get_contents($photo));

        Premium::create([
            'seller_id' => $user->id,
            'image' => Storage::disk('s3')->url($filepath, $filename)
        ]);

        $this->sendEmail($user);

        return response()->json([
            'message' => 'success',
            'status' => true,
            'data' => (object)[]
        ]);
    }

    private function sendEmail($user)
    {
        $details = [
            'greeting' => 'Hi Admin',
            'body' => $user->name .' ingin upgrade menjadi premium',
        ];

        $admin = Admin::first();
        $admin->premiumSendEmail($details);

        return true;
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
        $uploadFile = Helper::uploadFile($photo);
        // $filename = time() . '.' . $photo->getClientOriginalExtension();
        // $filepath = 'product/' . $filename;
        // Storage::disk('s3')->put($filepath, file_get_contents($photo));

        $user = Auth::guard('seller-api')->user();
        //$user->image = Storage::disk('s3')->url($filepath, $filename);
        $user->image = $uploadFile;
        $user->save();

        return response()->json([
            'message' => 'successfully update profile',
            'status' => true,
            'data' => $user
        ]);
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::guard('seller-api')->user();
        $user->password = Hash::make($request->password);
        $user->save();
            return response()->json([
                'message' => 'successfully update profile',
                'status' => true,
                'data' => (object)[]
            ]);
    }

    public function updateProfile(Request $request)
    {
            $user = Auth::guard('seller-api')->user();
            $user->name = $request->name;
            $user->address = $request->address;
            $user->phone = $request->phone;
            $user->save();
            return response()->json([
                'message' => 'successfully update profile',
                'status' => true,
                'data' => (object)[]
            ]);
    }
}
