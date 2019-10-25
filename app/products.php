<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    //
    protected $table = 'master_produk';
    public $timestamps = false;
    public function gambarProduct(){
    	return $this->hasMany('App\Gambar', 'id_products', 'id');
    }
    public function ukuranProduct(){
    	return $this->hasMany('App\Ukuran', 'id_products', 'id');
    }
    public function addonLogoProduct(){
        return $this->hasMany('App\AddonLogo', 'id_products', 'id');
    }
    public function hargaUkuranProduct()
    {
        return $this->hasManyThrough(
            'App\Harga',
            'App\Ukuran',
            'id_products', // Foreign key on users table...
            'id_ukuran', // Foreign key on posts table...
            'id', // Local key on countries table...
            'id' // Local key on users table...
        );
    }
}
