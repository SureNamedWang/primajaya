<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(AddonKainTableSeeder::class);
        $this->call(AddonLogoTableSeeder::class);
        $this->call(BahanTableSeeder::class);
        //$this->call(CartsListTableSeeder::class);
        $this->call(GambarTableSeeder::class);
        $this->call(HargaTableSeeder::class);
        //$this->call(KeranjangTableSeeder::class);
        //$this->call(OrdersTableSeeder::class);
        //$this->call(PembayaranTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(UkuranTableSeeder::class);
        $this->call(MasterUkuranTableSeeder::class);
        $this->call(MasterBahanTableSeeder::class);
        $this->call(TipeUkuranTableSeeder::class);
    }
}
