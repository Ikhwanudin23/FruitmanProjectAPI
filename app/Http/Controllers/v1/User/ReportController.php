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
				// $fruit = array_column($results, 'fruit');
				// $indexResults = array_search($order->name, $fruit);
				// $items = $results[$indexResults];
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
				
				// $results = array_map(function($a) use($order) {
				// 	foreach($a['items'] as $item){
				// 		if($item['month'] == $order->month){
				// 			$replacement = [
				// 				'month' => $item['month'],
				// 				'month_name' => Carbon::create()->month($item['month'])->startOfMonth()->translatedFormat('F'),
				// 				'value' => $order->count
				// 			];
				// 			return $replacement;
				// 		}
				// 	}
				// 	return $a;
				// }, $results);

				// $fruit = array_column($results, 'fruit');
				// $indexResults = array_search($order->name, $fruit);
				// $items = $results[$indexResults];
				// if($items){
				// 	$itemsMonths = $items['items'];
				// 	$indexMonths = array_search($order->month, array_column($itemsMonths, 'month'));
					
				// 		if($indexMonths){
				// 			$replacement = [
				// 				'month' => $itemsMonths[$indexMonths]['month'],
				// 				'month_name' => Carbon::create()->month($itemsMonths[$indexMonths]['month'])->startOfMonth()->translatedFormat('F'),
				// 				'value' => $order->count
				// 			];
				// 			$itemsMonths[$indexMonths] = $replacement;
				// 			//$results = array_replace($itemsMonths, array_fill_keys( array_keys($results, $items), $replacement));
				// 			//return response()->json($res);
							
				// 			//array_push($items, $itemsMonths[$indexMonths]);
				// 			//$results[$indexResults] = array_replace($items, $itemsMonths[$indexMonths]);
				// 			//return response()->json($itemsMonths[$indexMonths]);
				// 		}
				// }
				
				
				//if($indexMonths){
					// $replacement[$indexMonths] = [
					// 	'month' => $months[$indexMonths]['month'],
					// 	'month_name' => Carbon::create()->month($months[$indexMonths]['month'])->startOfMonth()->translatedFormat('F'),
					// 	'value' => 10
					// ];
					// $results = array_replace($results, $replacement);

					// $item = [
					// 	'fruit' => $order->name,
					// 	'items' => $replaceMonth
					// ];
					// array_push($results, $item);
				//}
			}
		}
		return response()->json([
			'count' => count($orders),
			'res' => $results,
			'rep' => $replacements,
		]);

		//array month harus di ganti lagi
		//loop
		//jika nama buah tidak ada maka push jika ada maka cek monthnya lalu ganti count / valuenya



		// $orders = Order::where('user_id', Auth::user()->id)
        //     ->where('status', '2')
        //     ->where('arrive', true)
        //     ->where('completed', true)->latest()->get();

		// $results = [];
		
		// foreach ($orders as $key => $order) {
		// 	$baseMonths = $months;
		// 	$keyArrMonth = array_search($order->created_at->format('m'), array_column($months, 'month'));
		// 	if($keyArrMonth){
		// 		$value = Order::where('user_id', Auth::user()->id)->where('status', '2')->where('arrive', true)
		// 		->where('completed', true)->whereMonth('created_at', $baseMonths[$keyArrMonth]['month'])->get()->count();

		// 		$replacement[$keyArrMonth] = [
		// 			'month' => $baseMonths[$keyArrMonth]['month'],
		// 			'month_name' => Carbon::create()->month($baseMonths[$keyArrMonth]['month'])->startOfMonth()->translatedFormat('F'),
		// 			'value' => $value
		// 		];
		// 		$baseMonths = array_replace($baseMonths, $replacement);
		// 	}
		// 	$item = [ $order->product->fruit->name => $baseMonths ];
		// 	array_push($results, $item);
		// }


		$results_expect = [
			[
				'product A' => [
					[ 'Januari' => '149' ],
					[ 'Februari' => '3' ],
					[ 'Maret' => '8' ],
				],
			],
			[
				'product B' => [
					[ 'Januari' => '149' ],
					[ 'Februari' => '3' ],
					[ 'Maret' => '8' ],
				]
			]
		];
        return response()->json([
            'message' => 'success',
            'status' => true,
			'data' => $results,
        ]);
	}

	function array_replace_key($search, $replace, array $subject) {
		$updatedArray = [];
	
		foreach ($subject as $key => $value) {
			if (!is_array($value) && $key == $search) {
				$updatedArray = array_merge($updatedArray, [$replace => $value]);			
				continue;
			}
	
			$updatedArray = array_merge($updatedArray, [$key => $value]);
		}
	
		return $updatedArray;
	}
}
