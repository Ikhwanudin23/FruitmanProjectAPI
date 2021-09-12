<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
			Adminseeder::class,
			FruitSeeder::class,
			SellerSeeder::class,
			SubDistrictSeeder::class,
			UserSeeder::class,
			ProductSeeder::class,
			OrderSeeder::class
		]);

    }
}
