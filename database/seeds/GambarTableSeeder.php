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
            'gambar' => 'la.jpg',
            'thumbnail' => 1,
        ]);
        DB::table('gambar')->insert([
            'id_products' => 1,
            'gambar' => 'ny.jpg',
            'thumbnail' => 0,
        ]);
        DB::table('gambar')->insert([
            'id_products' => 1,
            'gambar' => 'ny.jpg',
            'thumbnail' => 0,
        ]);
        DB::table('gambar')->insert([
            'id_products' => 2,
            'gambar' => 'ny.jpg',
            'thumbnail' => 1,
        ]);
        DB::table('gambar')->insert([
            'id_products' => 3,
            'gambar' => 'chicago.jpg',
            'thumbnail' => 1,
        ]);
    }
}
