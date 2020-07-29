<?php

namespace App\Http\Controllers\v1\Seller\Auth;

use App\Seller;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:seller');
    }

    public function register(Request $request)
    {
        try{

            $validator = Validator::make($request->all(),[
                'name' => 'required',
                'email' => 'required|unique:sellers',
                'password' => 'required',
                'phone' => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json(['message' => $validator->errors(), 'status' => false, 'data' => (object)[]]);
            }

            $seller = new Seller();
            $seller->name = $request->name;
            $seller->email = $request->email;
            $seller->password = Hash::make($request->password);
            $seller->phone = $request->phone;
            $seller->api_token = Str::random(80);
            $seller->fcm_token = $request->fcm_token;
            $seller->save();
            $seller->sendApiEmailVerificationNotification();
            $message = "Cek Email Anda, Verifikasi Dahulu";


            return response()->json([
                'message' => $message,
                'status' => true,
                'data' => $seller
            ]);

        }catch (\Exception $exception){

            return response()->json([
                'message' => $exception->getMessage(),
                'status' => false,
                'data' => (object)[]
            ]);
        }
    }
}
