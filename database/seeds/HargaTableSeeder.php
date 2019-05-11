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
            'nama' => 'Komplit',
            'harga' => 1100000,
        ]);
        DB::table('harga')->insert([
        	'id_ukuran' => 1,
            'nama' => 'Rangka',
            'harga' => 700000,
        ]);
        DB::table('harga')->insert([
        	'id_ukuran' => 1,
            'nama' => 'Kain',
            'harga' => 500000,
        ]);
        DB::table('harga')->insert([
        	'id_ukuran' => 2,
            'nama' => 'Komplit',
            'harga' => 1300000,
        ]);
        DB::table('harga')->insert([
        	'id_ukuran' => 2,
            'nama' => 'Rangka',
            'harga' => 800000,
        ]);
        DB::table('harga')->insert([
        	'id_ukuran' => 2,
            'nama' => 'Kain',
            'harga' => 600000,
        ]);
        DB::table('harga')->insert([
        	'id_ukuran' => 3,
            'nama' => 'Komplit',
            'harga' => 1400000,
        ]);
        DB::table('harga')->insert([
        	'id_ukuran' => 3,
            'nama' => 'Rangka',
            'harga' => 900000,
        ]);
        DB::table('harga')->insert([
        	'id_ukuran' => 3,
            'nama' => 'Kain',
            'harga' => 650000,
        ]);
        DB::table('harga')->insert([
        	'id_ukuran' => 4,
            'nama' => 'Komplit',
            'harga' => 1600000,
        ]);
        DB::table('harga')->insert([
        	'id_ukuran' => 4,
            'nama' => 'Rangka',
            'harga' => 1000000,
        ]);
        DB::table('harga')->insert([
        	'id_ukuran' => 5,
            'nama' => 'Komplit',
            'harga' => 1900000,
        ]);
        DB::table('harga')->insert([
        	'id_ukuran' => 5,
            'nama' => 'Rangka',
            'harga' => 1100000,
        ]);
        DB::table('harga')->insert([
        	'id_ukuran' => 5,
            'nama' => 'Kain',
            'harga' => 900000,
        ]);
        DB::table('harga')->insert([
        	'id_ukuran' => 6,
            'nama' => 'Komplit',
            'harga' => 2800000,
        ]);
        DB::table('harga')->insert([
        	'id_ukuran' => 6,
            'nama' => 'Rangka',
            'harga' => 1600000,
        ]);
        DB::table('harga')->insert([
        	'id_ukuran' => 6,
            'nama' => 'Kain',
            'harga' => 1300000,
        ]);
        DB::table('harga')->insert([
        	'id_ukuran' => 7,
            'nama' => 'Komplit',
            'harga' => 3400000,
        ]);
        DB::table('harga')->insert([
        	'id_ukuran' => 7,
            'nama' => 'Rangka',
            'harga' => 1900000,
        ]);
        DB::table('harga')->insert([
        	'id_ukuran' => 7,
            'nama' => 'Kain',
            'harga' => 1400000,
        ]);
        DB::table('harga')->insert([
            'id_ukuran' => 8,
            'nama' => 'Komplit',
            'harga' => 1000000,
        ]);
    }
}
