<?php

namespace App\Http\Controllers\BackOffice;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $datas = User::all();
        return view('pages.userlist', compact('datas'));
    }
}
