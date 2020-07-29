<?php

namespace App\Http\Controllers\Admin;

use App\Seller;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index() {
        $sellerlist = count(Seller::all());
        $userlist = count(User::all());


        return view('pages/dashboard',compact(['userlist','sellerlist']));

    }
}
