<?php

use Illuminate\Database\Seeder;

class UkuranTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('ukuran')->insert([
            'id_products' => 1,
            'id_mukuran' => 1,
        ]);
        DB::table('ukuran')->insert([
            'id_products' => 1,
            'id_mukuran' => 2,
        ]);
        DB::table('ukuran')->insert([
            'id_products' => 1,
            'id_mukuran' => 3,
        ]);
        DB::table('ukuran')->insert([
            'id_products' => 1,
            'id_mukuran' => 4,
        ]);
        DB::table('ukuran')->insert([
            'id_products' => 1,
            'id_mukuran' => 5,
        ]);
        DB::table('ukuran')->insert([
            'id_products' => 1,
            'id_mukuran' => 6,
        ]);
        DB::table('ukuran')->insert([
            'id_products' => 1,
            'id_mukuran' => 7,
        ]);
        DB::table('ukuran')->insert([
            'id_products' => 2,
            'id_mukuran' => 1,
        ]);
    }
}
