<?php

namespace App\Http\Controllers\v1\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Response;
use App\SubDistrict;

class SubDistrictController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $subDistricts = SubDistrict::all();
        return Response::transform('success', true, $subDistricts);
    }
}
