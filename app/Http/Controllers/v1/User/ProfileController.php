<?php

namespace App\Http\Controllers\v1\User;

use App\Admin;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\PremiumNotification;
use Notification;
use App\Premium;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function premium(Request $request)
    {
        $user = Auth::guard('api')->user();
        $photo = $request->file('image');
        $filename = time().'-'.$user->name. '.' . $photo->getClientOriginalExtension();
        $filepath = 'premium/' . $filename;
        Storage::disk('s3')->put($filepath, file_get_contents($photo));

        Premium::create([
            'user_id' => $user->id,
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
        $user = Auth::guard('api')->user();

        return response()->json([
            'message' => 'successfully get profile',
            'status' => true,
            'data' => new UserResource($user)
        ]);
    }

    public function updatePhoto(Request $request)
    {
        $photo = $request->file('image');
        $filename = time() . '.' . $photo->getClientOriginalExtension();
        $filepath = 'product/' . $filename;
        Storage::disk('s3')->put($filepath, file_get_contents($photo));

        $user = Auth::guard('api')->user();
        $user->image = Storage::disk('s3')->url($filepath, $filename);
        $user->update();

        return response()->json([
            'message' => 'successfully update profile',
            'status' => true,
            'data' => $user
        ]);
    }

    public function updatePassword(Request $request)
    {
            $user = Auth::guard('api')->user();
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
        $user = Auth::guard('api')->user();
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
