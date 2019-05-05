<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PembayaranTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('pembayaran')->insert([
            'id_orders' => 3,
            'bukti' => 'chicago.jpg',
            'jumlah' => 0,
            'approval' => 0,
            'created_at' => "2019-05-05 00:00:00",
        ]);
    }
}
