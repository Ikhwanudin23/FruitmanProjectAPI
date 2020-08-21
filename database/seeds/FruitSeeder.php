<?php

use App\Fruit;
use Illuminate\Database\Seeder;

class FruitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fruit = ['Duku','Durian','Duwet','Mangga','Durian','Semangka','Jeruk','Alpukat',
        'Belimbing','Anggur','Apel','Delima','Duku','Gowok','Jambu','Kelapa','Sawo'];

        for ($i=0; $i < count($fruit); $i++) { 
            Fruit::create([
                'name' => $fruit[$i]
            ]);
        }
    }
}
