<?php

use Illuminate\Database\Seeder;

class DepartemenTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('departemens')->insert([
        	'nama' => 'Produksi',
        ]);
        DB::table('departemens')->insert([
        	'nama' => 'Penjualan',
        ]);
    }
}
