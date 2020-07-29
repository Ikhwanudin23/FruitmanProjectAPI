<?php

namespace App\Http\Controllers\BackOffice;

use App\Order;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        $datas = Order::all()->where('completed','=','1');
        return view('pages.report',compact('datas'));
    }

    public function print(){
        $datas = Order::all()->where('completed','=','1')   ;
        $pdf =PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadview('pages.cobaprint', compact(['datas']));
        return $pdf->stream();
    }
}
