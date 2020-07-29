<?php

namespace App\Http\Controllers\v1\User\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:web');
    }

    public function login(Request $request)
    {
        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credential = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::guard('web')->attempt($credential)){
            $user = Auth::guard('web')->user();
            if ($user->email_verified_at != null){
                return response()->json([
                    'message' => 'login berhasil',
                    'status' => true,
                    'data' => $user
                ]);
            }else{
                return response()->json([
                    'message' => 'Silahkan Aktifasi Email Dahulu',
                    'status' => false,
                ], 401);
            }
        }

        return response()->json([
            'message' => 'login gagal',
            'status' => false,
            'data' => (object) []
        ]);
    }
}
