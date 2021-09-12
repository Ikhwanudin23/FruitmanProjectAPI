<?php

use App\Order;
use App\User;
use App\Seller;
use App\Product;
use Faker\Factory;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

		$sellers = Seller::pluck('id')->toArray();
		$users = User::pluck('id')->toArray();
		$products = Product::pluck('id')->toArray();

		for ($i=0; $i < 200; $i++) { 
			
			Order::create([
				'user_id' => $users[array_rand($users)],
				'seller_id' => $sellers[array_rand($sellers)],
				'product_id' => $products[array_rand($products)],
				'offer_price' => 0,
				'completed' => true,
				'status' => '2',
				'arrive' => true,
				'created_at' => $faker->dateTimeBetween('-8 months', '+3 months'),
				'updated_at' => $faker->date('Y-m-d')
			]);
		}
    }
}
