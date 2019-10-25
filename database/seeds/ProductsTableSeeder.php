<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('master_produk')->insert([
            'nama' => 'Tenda Display',
            'detail' => 'Tenda yang biasa digunakan untuk membuka stand baik dalam event/pameran maupun berdagang sehari-hari',
        ]);
        DB::table('master_produk')->insert([
            'nama' => 'Tenda Cafe',
            'detail' => 'Meja yang dilengkapi dengan payung, cocok digunakan untuk bagian outdoor cafe/restoran. Bisa juga digunakan bagi kegiatan outdoor di belakang rumah anda seperti barbeque.',
        ]);
    }
}
