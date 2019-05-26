<?php

use Illuminate\Database\Seeder;

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
    }
}
