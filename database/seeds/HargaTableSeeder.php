<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HargaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('harga')->insert([
        	'id_ukuran' => 1,
            'id_tipe' => 1,
            'harga' => 1100000,
        ]);
        DB::table('harga')->insert([
        	'id_ukuran' => 1,
            'id_tipe' => 2,
            'harga' => 700000,
        ]);
        DB::table('harga')->insert([
        	'id_ukuran' => 1,
            'id_tipe' => 3,
            'harga' => 500000,
        ]);
        DB::table('harga')->insert([
        	'id_ukuran' => 2,
            'id_tipe' => 1,
            'harga' => 1300000,
        ]);
        DB::table('harga')->insert([
        	'id_ukuran' => 2,
            'id_tipe' => 2,
            'harga' => 800000,
        ]);
        DB::table('harga')->insert([
        	'id_ukuran' => 2,
            'id_tipe' => 3,
            'harga' => 600000,
        ]);
        DB::table('harga')->insert([
        	'id_ukuran' => 3,
            'id_tipe' => 1,
            'harga' => 1400000,
        ]);
        DB::table('harga')->insert([
        	'id_ukuran' => 3,
            'id_tipe' => 2,
            'harga' => 900000,
        ]);
        DB::table('harga')->insert([
        	'id_ukuran' => 3,
            'id_tipe' => 3,
            'harga' => 650000,
        ]);
        DB::table('harga')->insert([
        	'id_ukuran' => 4,
            'id_tipe' => 1,
            'harga' => 1600000,
        ]);
        DB::table('harga')->insert([
        	'id_ukuran' => 4,
            'id_tipe' => 2,
            'harga' => 1000000,
        ]);
        DB::table('harga')->insert([
            'id_ukuran' => 4,
            'id_tipe' => 3,
            'harga' => 800000,
        ]);
        DB::table('harga')->insert([
        	'id_ukuran' => 5,
            'id_tipe' => 1,
            'harga' => 1900000,
        ]);
        DB::table('harga')->insert([
        	'id_ukuran' => 5,
            'id_tipe' => 2,
            'harga' => 1100000,
        ]);
        DB::table('harga')->insert([
        	'id_ukuran' => 5,
            'id_tipe' => 3,
            'harga' => 900000,
        ]);
        DB::table('harga')->insert([
        	'id_ukuran' => 6,
            'id_tipe' => 1,
            'harga' => 2800000,
        ]);
        DB::table('harga')->insert([
        	'id_ukuran' => 6,
            'id_tipe' => 2,
            'harga' => 1600000,
        ]);
        DB::table('harga')->insert([
        	'id_ukuran' => 6,
            'id_tipe' => 3,
            'harga' => 1300000,
        ]);
        DB::table('harga')->insert([
        	'id_ukuran' => 7,
            'id_tipe' => 1,
            'harga' => 3400000,
        ]);
        DB::table('harga')->insert([
        	'id_ukuran' => 7,
            'id_tipe' => 1,
            'harga' => 1900000,
        ]);
        DB::table('harga')->insert([
        	'id_ukuran' => 7,
            'id_tipe' => 2,
            'harga' => 1400000,
        ]);
        DB::table('harga')->insert([
            'id_ukuran' => 8,
            'id_tipe' => 3,
            'harga' => 1000000,
        ]);
    }
}
