<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('orders')->insert([
            'id_carts_list' => 1,
            'id_user' =>1,
            'subtotal' => 1000000,
            'biaya_kirim' => 50000,
            'total' => 1050000,
            'dp' => 3500000,
            'status' => "selesai",
            'total_pembayaran' => 1050000,
            'created_at' => "2019-01-04 00:00:00",
            'updated_at' => "2019-03-04 00:00:00",
        ]);
        DB::table('orders')->insert([
            'id_carts_list' => 2,
            'id_user' =>1,
            'subtotal' => 2000000,
            'biaya_kirim' => 500000,
            'total' => 2500000,
            'dp' => 750000,
            'status' => "aktif",
            'total_pembayaran' => 2500000,
            'created_at' => "2019-04-14 00:00:00",
            'updated_at' => "2019-05-05 00:00:00",
        ]);
        DB::table('orders')->insert([
            'id_carts_list' => 3,
            'id_user' =>2,
            'subtotal' => 10000000,
            'biaya_kirim' => 0,
            'total' => 10000000,
            'dp' => 0,
            'status' => "aktif",
            'total_pembayaran' => 0,
            'created_at' => "2019-05-05 00:00:00",
            'updated_at' => "2019-05-05 00:00:00",
        ]);
    }
}
