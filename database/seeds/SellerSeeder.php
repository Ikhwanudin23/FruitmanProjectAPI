<?php

use App\Seller;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SellerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Seller::create([
            'name' => 'ikhwan',
            'email' => 'ikhwan@gmail.com',
            'password' => Hash::make('12345678'),
            'phone' => '1234',
            'api_token' => 'token_ikhwan'
        ]);

        Seller::create([
            'name' => 'damar',
            'email' => 'damar@gmail.com',
            'password' => Hash::make('12345678'),
            'phone' => '12345',
            'api_token' => 'token_damar'
        ]);
    }
}
