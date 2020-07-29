<?php

namespace App\Http\Controllers\v1\Seller\Auth;

use App\Http\Controllers\Controller;
use App\Seller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:seller');
    }

    public function guard()
    {
        return Auth::guard('seller');
    }

    public function broker()
    {
        return Password::broker('sellers');
    }

    public function showResetForm(Request $request, $token  = null)
    {
        return view('auth-seller.passwords.reset')->with(['token' => $token, 'email' => $request->email]);
    }

    protected function reset(Request $request)
    {
        $driver = Seller::where('email', $request->email)->first();
        $driver->password = Hash::make($request->password);
        $driver->setRememberToken(Str::random(60));
        $driver->update();

        return 'berhasil reset password, silahkan kembali ke aplikasi';
    }
}
