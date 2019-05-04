<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    //
    protected $table = 'keranjang';
    public $timestamps = false;

    public function keranjangProducts()
    {
        return $this->hasOne('App\Products', 'id', 'id_products');
    }

    public function keranjangKain()
    {
        return $this->hasOne('App\AddonKain', 'id', 'id_kain');
    }

    public function keranjangLogo()
    {
        return $this->hasOne('App\AddonLogo', 'id', 'id_logo');
    }

    public function keranjangHarga()
    {
        return $this->hasOne('App\Harga', 'id', 'id_harga');
    }

    public function keranjangGambar()
    {
        return $this->hasOne('App\Gambar', 'id', 'id_gambar');
    }
}
