<?php

use Illuminate\Database\Seeder;

class DivisiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('divisis')->insert([
        	'nama' => 'Rangka',
            'departemens_id' => 1,
            'tipeGaji' => 'hari',
        ]);
        DB::table('divisis')->insert([
        	'nama' => 'Kain',
            'departemens_id' => 1,
            'tipeGaji' => 'barang',
        ]);
        DB::table('divisis')->insert([
        	'nama' => 'Front Desk',
            'departemens_id' => 2,
            'tipeGaji' => 'bulan',
        ]);
    }
}
