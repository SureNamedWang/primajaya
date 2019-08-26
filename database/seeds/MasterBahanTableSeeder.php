<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterBahanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('master_bahans')->insert([
            'nama' => 'besi',
        ]);
        DB::table('master_bahans')->insert([
            'nama' => 'kain',
        ]);
    }
}
