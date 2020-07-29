<?php

namespace App\Http\Controllers\v1\User\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:web');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
            'phone' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors(), 'status' => false, 'data' => (object)[]]);
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone = $request->phone;
        $user->api_token = Str::random(80);
        $user->fcm_token = $request->fcm_token;
        $user->save();
        $user->sendApiEmailVerificationNotification();
        $message = "Cek Email Anda, Verifikasi Dahulu";

        return response()->json([
            'message' => $message,
            'status' => true,
            'data' => $user
        ]);
    }
}
