<?php

use App\Fruit;
use App\Product;
use App\Seller;
use App\SubDistrict;
use Illuminate\Database\Seeder;
use Faker\Factory;

class ProductSeeder extends Seeder
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
		$fruits = Fruit::pluck('id')->toArray();
		$subDistricts = SubDistrict::pluck('id')->toArray();
		$prices = [10000, 20000, 30000, 40000, 50000, 60000, 70000, 80000, 90000, 100000];
		for ($i=0; $i < 100; $i++) { 
			Product::create([
				'seller_id' => $sellers[array_rand($sellers)],
				'fruit_id' => $fruits[array_rand($fruits)],
				'sub_district_id' => $subDistricts[array_rand($subDistricts)],
				'description' => $faker->paragraph,
				'price' => $prices[array_rand($prices)],
				'address' => $faker->address,
				'latitude' => $faker->latitude,
				'longitude' => $faker->longitude
			]);
		}
    }
}
