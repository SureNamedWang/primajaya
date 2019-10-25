<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Keranjang extends Model
{
    //
    protected $table = 'keranjang';
    public $timestamps = false;
    use SoftDeletes;

    public function keranjangProducts()
    {
        return $this->hasOne('App\Products', 'id', 'id_products');
    }

    public function keranjangLogo()
    {
        return $this->hasOne('App\AddonLogo', 'id', 'id_logo');
    }

    public function keranjangHarga()
    {
        return $this->hasOne('App\Harga', 'id', 'id_produk');
    }

    public function keranjangGambar()
    {
        return $this->hasOne('App\Gambar', 'id', 'id_gambar');
    }

    public function keranjangOrders()
    {
        return $this->hasOne('App\Orders', 'id', 'id_orders');
    }

    public function keranjangProduksi()
    {
        return $this->hasMany('App\Produksi', 'id_keranjang', 'id');
    }
}
