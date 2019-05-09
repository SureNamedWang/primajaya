<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CartsListTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('carts_list')->insert([
            'id_user' => 1,
            'status' => 1,
        ]);
    }
}
