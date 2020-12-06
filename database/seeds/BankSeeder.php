<?php

use App\Bank;
use Illuminate\Database\Seeder;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bank::create([
            'admin_id'          => 1,
            'bank_name'         => 'BRI',
            'account_name'      => 'FruitMan',
            'account_number'    => '327101041713533'
        ]);
    }
}
