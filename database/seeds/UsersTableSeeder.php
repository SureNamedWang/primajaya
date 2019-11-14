<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'name' => 'Boss',
            'email' => 'owner@owner.com',
            'password' => bcrypt('12345678'),
            'admin' => 'Pemilik',
            'telp' =>'12345678',
            'alamat' =>'Tenggilis Mejoyo 32'
        ]);
        DB::table('users')->insert([
            'name' => 'Nick',
            'email' => 'admin@admin.com',
            'password' => bcrypt('12345678'),
            'admin' => 'Admin',
            'telp' =>'12345678',
            'alamat' =>'Tenggilis Mejoyo 32'
        ]);
        DB::table('users')->insert([
            'name' => 'Moses',
            'email' => 'test@semuabisa.com',
            'password' => bcrypt('12345678'),
            'admin' => 'User',
            'telp' =>'12345678',
            'alamat' =>'Tenggilis Mejoyo 32'
        ]);
        DB::table('users')->insert([
            'name' => 'FHan',
            'email' => 'fhan@gmail.com',
            'password' => bcrypt('fhanfhan'),
            'admin' => 'User',
            'telp' =>'12345678',
            'alamat' =>'Tenggilis Mejoyo 32'
        ]);
    }
}
