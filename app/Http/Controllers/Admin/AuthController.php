<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\VarDumper\Dumper\DataDumperInterface;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function getLogin() {
        return view('auth-admin.loginForm');
    }

    public function login(Request $request){

        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credential = [
            'email'=> $request->email,
            'password'=> $request->password
        ];

        if (Auth::guard('admin')->attempt($credential)){

            return redirect()->route('index');
        }
        return redirect()->back()->with('error', 'Masukkan email dan password yang benar');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.getLogin');
    }
}
