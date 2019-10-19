<?php

use Illuminate\Database\Seeder;

class KaryawanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('karyawans')->insert([
        	'nama' => 'Ahmad Mochtar',
            'sex' => 'pria',
            'divisis_id' => 1,
            'gaji' => 150000,
        ]);
        DB::table('karyawans')->insert([
        	'nama' => 'Muhammad Rusli Abdul Gani',
            'sex' => 'pria',
            'divisis_id' => 1,
            'gaji' => 150000,
        ]);
        DB::table('karyawans')->insert([
        	'nama' => 'Desi Anggraeni',
            'sex' => 'wanita',
            'divisis_id' => 2,
            'gaji' => 50000,
        ]);
        DB::table('karyawans')->insert([
        	'nama' => 'Hartati Kumalasari',
            'sex' => 'wanita',
            'divisis_id' => 2,
            'gaji' => 50000,
        ]);
        DB::table('karyawans')->insert([
        	'nama' => 'Nicky Yusop',
            'sex' => 'wanita',
            'divisis_id' => 3,
            'gaji' => 5000000,
        ]);
    }
}
