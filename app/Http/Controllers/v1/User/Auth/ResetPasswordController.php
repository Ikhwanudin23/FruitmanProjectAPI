<?php

namespace App\Http\Controllers\v1\User\Auth;

use App\Http\Controllers\Controller;
use App\User;
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
        $this->middleware('guest:web');
    }

    public function guard()
    {
        return Auth::guard('web');
    }

    public function broker()
    {
        return Password::broker('sellers');
    }

    public function showResetForm(Request $request, $token  = null)
    {
        return view('auth-user.passwords.reset')->with(['token' => $token, 'email' => $request->email]);
    }

    protected function reset(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->setRememberToken(Str::random(60));
        $user->update();

        return response()->json([
            'status' => true,
            'message' => 'berhasil reset password, silahkan kembali ke aplikasi',
            'data' => (object)[]
        ]);
    }
}
