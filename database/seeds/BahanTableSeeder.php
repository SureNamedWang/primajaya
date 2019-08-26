<?php

use Illuminate\Database\Seeder;

class BahanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('bahans')->insert([
            'id_ukuran' => 1,
            'id_master_bahan' => 1,
            'jumlah' => 16,
        ]);
        DB::table('bahans')->insert([
            'id_ukuran' => 1,
            'id_master_bahan' => 2,
            'jumlah' => 20,
        ]);
        DB::table('bahans')->insert([
            'id_ukuran' => 2,
            'id_master_bahan' => 1,
            'jumlah' => 17,
        ]);
        DB::table('bahans')->insert([
            'id_ukuran' => 2,
            'id_master_bahan' => 2,
            'jumlah' => 22,
        ]);
        DB::table('bahans')->insert([
            'id_ukuran' => 3,
            'id_master_bahan' => 1,
            'jumlah' => 20,
        ]);
        DB::table('bahans')->insert([
            'id_ukuran' => 3,
            'id_master_bahan' => 2,
            'jumlah' => 25,
        ]);
        DB::table('bahans')->insert([
            'id_ukuran' => 4,
            'id_master_bahan' => 1,
            'jumlah' => 22,
        ]);
        DB::table('bahans')->insert([
            'id_ukuran' => 4,
            'id_master_bahan' => 2,
            'jumlah' => 25,
        ]);
        DB::table('bahans')->insert([
            'id_ukuran' => 5,
            'id_master_bahan' => 1,
            'jumlah' => 28,
        ]);
        DB::table('bahans')->insert([
            'id_ukuran' => 5,
            'id_master_bahan' => 2,
            'jumlah' => 34,
        ]);
        DB::table('bahans')->insert([
            'id_ukuran' => 6,
            'id_master_bahan' => 1,
            'jumlah' => 30,
        ]);
        DB::table('bahans')->insert([
            'id_ukuran' => 6,
            'id_master_bahan' => 2,
            'jumlah' => 40,
        ]);
        DB::table('bahans')->insert([
            'id_ukuran' => 7,
            'id_master_bahan' => 1,
            'jumlah' => 32,
        ]);
        DB::table('bahans')->insert([
            'id_ukuran' => 7,
            'id_master_bahan' => 2,
            'jumlah' => 45,
        ]);
        DB::table('bahans')->insert([
            'id_ukuran' => 8,
            'id_master_bahan' => 1,
            'jumlah' => 16,
        ]);
        DB::table('bahans')->insert([
            'id_ukuran' => 8,
            'id_master_bahan' => 2,
            'jumlah' => 20,
        ]);
    }
}
