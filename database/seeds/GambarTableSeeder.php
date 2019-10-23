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
            'gambar' => 'barang/barang1-1.jpg',
            'thumbnail' => 1,
        ]);
        DB::table('gambar')->insert([
            'id_products' => 1,
            'gambar' => 'barang/barang1-2.jpg',
            'thumbnail' => 0,
        ]);
        DB::table('gambar')->insert([
            'id_products' => 1,
            'gambar' => 'barang/barang1-3.jpg',
            'thumbnail' => 0,
        ]);
        DB::table('gambar')->insert([
            'id_products' => 1,
            'gambar' => 'barang/barang1-4.jpg',
            'thumbnail' => 0,
        ]);
        DB::table('gambar')->insert([
            'id_products' => 2,
            'gambar' => 'barang/barang2-1.jpg',
            'thumbnail' => 1,
        ]);
        DB::table('gambar')->insert([
            'id_products' => 2,
            'gambar' => 'barang/barang2-2.jpg',
            'thumbnail' => 0,
        ]);
    }
}
