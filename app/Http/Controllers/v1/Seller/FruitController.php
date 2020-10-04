<?php

namespace App\Http\Controllers\v1\Seller;

use App\Fruit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Response;

class FruitController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:seller-api');
    }

    public function index()
    {
        $fruits= Fruit::all();
        return Response::transform('success', true, $fruits);
    }
}
