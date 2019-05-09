<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KeranjangTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('keranjang')->insert([
            'id_carts_list' => 1,
            'id_products' => 1,
            'jumlah' => 1,
            'id_harga' => 7,
            'id_kain' => 4,
            'id_logo' => 1,
            'desain' => null,
            'harga' => 2600000,
        ]);
    }
}
