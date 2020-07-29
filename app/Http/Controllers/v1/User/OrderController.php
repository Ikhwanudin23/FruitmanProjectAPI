<?php

namespace App\Http\Controllers\v1\User;

use App\Http\Controllers\v1\FirebaseController;
use App\Http\Resources\User\OrderResource;
use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;

class OrderController extends Controller
{
    public function __construct()
    {

        $this->middleware("auth:api");
    }

    public function userWaiting()
    {
        $orders = Order::where('user_id', Auth::user()->id)
            ->where('status', '1')
            ->where('arrive', false)
            ->where('completed', false)->get();
        return response()->json([
            'message' => 'success',
            'status' => true,
            'data' => OrderResource::collection($orders),
        ]);
    }

    public function userInProgress()
    {
        $orders = Order::where('user_id', Auth::user()->id)
            ->where('status', '2')
            ->where('completed', false)->get();
        return response()->json([
            'message' => 'success',
            'status' => true,
            'data' => OrderResource::collection($orders),
        ]);
    }

    public function userComplete()
    {
        $orders = Order::where('user_id', Auth::user()->id)
            ->where('status', '2')
            ->where('arrive', true)
            ->where('completed', true)->get();
        return response()->json([
            'message' => 'success',
            'status' => true,
            'data' => OrderResource::collection($orders),
        ]);
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

            $token = $order->seller->fcm_token;
            $message = "Pesanan di batalkan oleh pembeli";
            $sendNotif = new FirebaseController();
            $sendNotif->sendNotificationFirebase($token, $message);

            return response()->json([
                'message' => 'successfully decline order',
                'status' => true,
                'data' => (object)[]
            ]);
        }
    }

    public function store (Request $request)
    {
        try {

            $validator = Validator::make($request->all(), ['offer_price' => 'required|numeric']);

            if ($validator->fails()) {
                return response()->json(['message' => $validator->errors(), 'status' => false, 'data' => (object)[]]);
            }

            $order = Order::create([
                'user_id' => Auth::user()->id,
                'seller_id' => $request->seller_id,
                'product_id' => $request->product_id,
                'offer_price' => $request->offer_price,
            ]);

            $token = $order->seller->fcm_token;
            $message = "Ada Pesanan silahkan cek";

            $optionBuilder = new OptionsBuilder();
            $optionBuilder->setTimeToLive(60*20);

            $notificationBuilder = new PayloadNotificationBuilder('FruitMan');
            $notificationBuilder->setBody($message)->setSound('default');

            $dataBuilder = new PayloadDataBuilder();
            $dataBuilder->addData(['a_data' => 'my_data']);

            $option = $optionBuilder->build();
            $notification = $notificationBuilder->build();

            $data = $dataBuilder->build();
            FCM::sendTo($token, $option, $notification, $data);

            return response()->json([
                'message' => 'success',
                'status' => true,
                'data' => new OrderResource($order)
            ]);

        } catch (\Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
                'status' => false,
                'data' => (object)[],
            ]);
        }
    }

    public function arrived($id)
    {
        $order = Order::findOrFail($id);
        $order->arrive = true;
        $order->update();

        $token = $order->seller->fcm_token;
        $message = "Seller sudah sampai";
        $sendNotif = new FirebaseController();
        $sendNotif->sendNotificationFirebase($token, $message);
        return response()->json([
            'message' => 'i arrive to your home',
            'status' => true,
            'data' => (object)[],
        ]);
    }
}
