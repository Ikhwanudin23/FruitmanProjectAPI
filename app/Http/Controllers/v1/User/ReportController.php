<?php

namespace App\Http\Controllers\v1\User;

use DateTime;
use App\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\User\OrderResource;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
	public function __construct()
    {

        $this->middleware("auth:api");
    }
    public function index()
	{
		$orders = DB::select("SELECT fruits.name, MONTH(orders.created_at) month, COUNT(*) count 
		FROM orders 
		INNER JOIN products ON orders.product_id = products.id
		INNER JOIN fruits on products.fruit_id = fruits.id
		WHERE orders.user_id = ".Auth::id()." AND orders.status = '2' 
		-- WHERE orders.user_id = 3 AND orders.status = '2' 
		AND orders.arrive = true AND orders.completed = true
		GROUP BY fruits.name, MONTH(orders.created_at)
		ORDER BY fruits.name, MONTH(orders.created_at)");

		//return response()->json($orders);

		$months = [];
		for ($i=1; $i <= 12; $i++) { 
			$item = [
				'month' => $i,
				'month_name' => Carbon::create()->month($i)->startOfMonth()->translatedFormat('F'),
				'value' => 0
			];
			array_push($months, $item);
		}

		$results = [];
		$replacements = [];
		foreach ($orders as $key => $order) {
			if(!in_array($order->name, array_column($results, 'fruit') )){
				$indexMonths = array_search($order->month, array_column($months, 'month'));
				$replacement[$indexMonths] = [
					'month' => $months[$indexMonths]['month'],
					'month_name' => Carbon::create()->month($months[$indexMonths]['month'])->startOfMonth()->translatedFormat('F'),
					'value' => $order->count
				];
				$replaceMonth = array_replace($months, $replacement);

				$item = [
					'fruit' => $order->name,
					'items' => $replaceMonth
				];
				array_push($results, $item);
			}else{
				foreach ($results as $keyResult => $result) {
					if($result['fruit'] == $order->name){
						foreach ($result['items'] as $keyItem => $item) {
							if($result['fruit'] == $order->name && $item['month'] == $order->month){
								$results[$keyResult]['items'][$keyItem] = [
									'month' => $item['month'],
									'month_name' => Carbon::create()->month($item['month'])->startOfMonth()->translatedFormat('F'),
									'value' => $order->count
								];
							}	
						}
					}
					
				}
			}
		}
        return response()->json([
            'message' => 'success',
            'status' => true,
			'data' => $results,
        ]);
	}
}
