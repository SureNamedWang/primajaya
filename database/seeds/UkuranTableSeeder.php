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
            'ukuran' => '2x2',
        ]);
        DB::table('ukuran')->insert([
            'id_products' => 1,
            'ukuran' => '2x2.5',
        ]);
        DB::table('ukuran')->insert([
            'id_products' => 1,
            'ukuran' => '3x3',
        ]);
        DB::table('ukuran')->insert([
            'id_products' => 1,
            'ukuran' => '3x4',
        ]);
        DB::table('ukuran')->insert([
            'id_products' => 1,
            'ukuran' => '4x4',
        ]);
        DB::table('ukuran')->insert([
            'id_products' => 1,
            'ukuran' => '4x5',
        ]);
        DB::table('ukuran')->insert([
            'id_products' => 1,
            'ukuran' => '4x6',
        ]);
        DB::table('ukuran')->insert([
            'id_products' => 2,
            'ukuran' => '2x2',
        ]);
    }
}
