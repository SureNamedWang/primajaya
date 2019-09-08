<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipeUkuranTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('tipe_ukuran')->insert([
            'nama' => 'Komplit',
        ]);
        DB::table('tipe_ukuran')->insert([
            'nama' => 'Rangka',
        ]);
        DB::table('tipe_ukuran')->insert([
            'nama' => 'Kain',
        ]);
        DB::table('tipe_ukuran')->insert([
            'nama' => 'Parasut',
        ]);
        DB::table('tipe_ukuran')->insert([
            'nama' => 'Parasol',
        ]);
    }
}
