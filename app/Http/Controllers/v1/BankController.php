<?php

namespace App\Http\Controllers\v1;

use App\Bank;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BankController extends Controller
{
    public function fetchBank()
    {
        $banks = Bank::first();

        return response()->json([
            'message' => 'success',
            'status' => true,
            'data' => $banks
        ]);
    }
}
