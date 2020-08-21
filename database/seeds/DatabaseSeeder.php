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
        $this->call(Adminseeder::class);
        $this->call(FruitSeeder::class);
        $this->call(SellerSeeder::class);
        $this->call(SubDistrictSeeder::class);
        $this->call(UserSeeder::class);
    }
}
