<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddonKainTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('addon_kain')->insert([
            'id_products' =>1,
            'nama' => 'kain parasut 1.3m',
            'harga' => 500000,
        ]);
        DB::table('addon_kain')->insert([
            'id_products' =>1,
            'nama' => 'kain parasut 1.5m',
            'harga' => 700000,
        ]);
        DB::table('addon_kain')->insert([
            'id_products' =>1,
            'nama' => 'kain parasol 1.3m',
            'harga' => 700000,
        ]);
        DB::table('addon_kain')->insert([
            'id_products' =>1,
            'nama' => 'kain parasol 1.5m',
            'harga' => 950000,
        ]);
    }
}
