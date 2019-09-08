<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterUkuranTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('master_ukuran')->insert([
            'ukuran' => '2x2',
        ]);
        DB::table('master_ukuran')->insert([
            'ukuran' => '2x2.5',
        ]);
        DB::table('master_ukuran')->insert([
            'ukuran' => '3x3',
        ]);
        DB::table('master_ukuran')->insert([
            'ukuran' => '3x4',
        ]);
        DB::table('master_ukuran')->insert([
            'ukuran' => '4x4',
        ]);
        DB::table('master_ukuran')->insert([
            'ukuran' => '4x5',
        ]);
        DB::table('master_ukuran')->insert([
            'ukuran' => '4x6',
        ]);
        // DB::table('master_ukuran')->insert([
        //     'ukuran' => 'parasut 1.3m',
        // ]);
        // DB::table('master_ukuran')->insert([
        //     'ukuran' => 'parasut 1.5m',
        // ]);
        // DB::table('master_ukuran')->insert([
        //     'ukuran' => 'parasol 1.3m',
        // ]);
        // DB::table('master_ukuran')->insert([
        //     'ukuran' => 'parasol 1.5m',
        // ]);
    }
}
