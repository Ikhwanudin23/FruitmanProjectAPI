<?php

namespace App\Http\Controllers\v1\Seller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Response;
use App\SubDistrict;

class SubdistrictController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:seller-api');
    }

    public function index()
    {
        $subDistricts = SubDistrict::all();
        return Response::transform('success', true, $subDistricts);
    }
}
