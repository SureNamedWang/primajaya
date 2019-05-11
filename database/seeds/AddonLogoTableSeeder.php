<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddonLogoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('addon_logo')->insert([
            'id_products' =>1,
            'nama' => 'Logo',
            'harga' => 200000,
        ]);
        DB::table('addon_logo')->insert([
            'id_products' =>1,
            'nama' => 'Logo+Desain',
            'harga' => 250000,
        ]);
    }
}
