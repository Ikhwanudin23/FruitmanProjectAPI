<?php

use App\Seller;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory;

class SellerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
		for ($i=0; $i < 3; $i++) { 
			Seller::create([
				'name' => $faker->name,
			    'email' => $faker->unique()->safeEmail,
			    'password' => Hash::make('password'),
			    'phone' => $faker->unique()->phoneNumber,
			    'api_token' => 'token_'.$faker->name,
			    'fcm_token' => 'fcm_token_'.$faker->name		
			]);
		}
    }
}
