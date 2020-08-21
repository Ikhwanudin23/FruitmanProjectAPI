<?php

use App\SubDistrict;
use Illuminate\Database\Seeder;

class SubDistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kecamatan = ['Margasari', 'Bumijawa','Bojong','Balapulang','Pagerbarang','Lebaksiu',
        'Jatinegara','Kedung Banteng','Pangkah','Slawi','Dukuhwaru','Adiwerna','DukuhTuri',
        'Talang','Tarub','Kramat','Surodadi','Warureja'];

        for ($i=0; $i < count($kecamatan); $i++) { 
            SubDistrict::create([
                'name' => $kecamatan[$i]
            ]);
        }
    }
}
