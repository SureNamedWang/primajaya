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
        DB::table('master_tipe')->insert([
            'nama' => 'Komplit',
        ]);
        DB::table('master_tipe')->insert([
            'nama' => 'Rangka',
        ]);
        DB::table('master_tipe')->insert([
            'nama' => 'Kain',
        ]);
        DB::table('master_tipe')->insert([
            'nama' => 'Parasut',
        ]);
        DB::table('master_tipe')->insert([
            'nama' => 'Parasol',
        ]);
    }
}
