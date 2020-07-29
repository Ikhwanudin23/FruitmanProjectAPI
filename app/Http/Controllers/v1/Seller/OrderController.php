<?php

namespace App\Http\Controllers\v1\Seller;

use App\Http\Controllers\v1\FirebaseController;
use App\Http\Resources\Seller\OrderResource;
use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:seller-api');
    }

    public function sellerOrderIn()
    {
        $orders = Order::where('seller_id', Auth::user()->id)
            ->where('status', '1')
            ->where('arrive', false)
            ->where('completed', false)->get();
        return response()->json([
            'message' => 'success',
            'status' => true,
            'data' => OrderResource::collection($orders),
        ]);
    }

    public function sellerInProgress()
    {
        $orders = Order::where('seller_id', Auth::user()->id)
            ->where('status', '2')
            ->where('completed', false)->get();

        return response()->json([
            'message' => 'success',
            'status' => true,
            'data' => OrderResource::collection($orders),
        ]);
    }

    public function sellerComplete(){
        $orders = Order::where('seller_id', Auth::user()->id)
            ->where('status', '2')
            ->where('arrive', true)
            ->where('completed', true)->get();

        return response()->json([
            'message' => 'success',
            'status' => true,
            'data' => OrderResource::collection($orders),
        ]);
    }

    public function confirmed($id)
    {
        $order = Order::findOrFail($id);

        if ($order->status == '0'){
            return response()->json([
                'message' => 'orderan sudah di batalkan sama pembeli',
                'status' => false
            ]);
        }else{
            $order->update(['status' => '2']);
            $token = $order->user->fcm_token;
            $message = "Pesanan di konfirmasi oleh penjual";
            $sendNotif = new FirebaseController();
            $sendNotif->sendNotificationFirebase($token, $message);

            return response()->json([
                'message' => 'successfully confirmed order',
                'status' => true,
                'data' => (object)[]
            ]);
        }
    }

    public function decline($id)
    {
        $order = Order::findOrFail($id);

        if ($order->status == '2'){
            return response()->json([
                'message' => 'orderan sudah di konfirmasi sama penjual',
                'status' => false
            ]);
        }else{
            $order->update(['status' => '0']);

            $token = $order->user->fcm_token;
            $message = "Pesanan di batalkan oleh penjual";
            $sendNotif = new FirebaseController();
            $sendNotif->sendNotificationFirebase($token, $message);

            return response()->json([
                'message' => 'successfully decline order',
                'status' => true,
                'data' => (object)[]
            ]);
        }


    }

    public function completed($id)
    {
        $order = Order::findOrFail($id);
        $order->completed = true;
        $order->update();

        return response()->json([
            'message' => 'completed order',
            'status' => true,
            'data' => (object)[],
        ]);
    }
}
