<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GambarTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('gambar')->insert([
            'id_products' => 1,
            'gambar' => 'barang/la.jpg',
            'thumbnail' => 1,
        ]);
        DB::table('gambar')->insert([
            'id_products' => 1,
            'gambar' => 'barang/ny.jpg',
            'thumbnail' => 0,
        ]);
        DB::table('gambar')->insert([
            'id_products' => 1,
            'gambar' => 'barang/ny.jpg',
            'thumbnail' => 0,
        ]);
        DB::table('gambar')->insert([
            'id_products' => 2,
            'gambar' => 'barang/chicago.jpg',
            'thumbnail' => 1,
        ]);
    }
}
