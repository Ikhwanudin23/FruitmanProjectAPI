<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'udin',
            'email' => 'udin@gmail.com',
            'password' => Hash::make('12345678'),
            'phone' => '1234',
            'api_token' => 'token_udin'
        ]);
    }
}
