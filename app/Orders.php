<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    //
    protected $table = 'orders';

    public function keranjangOrders()
    {
        return $this->hasOne('App\Keranjang', 'id', 'id_carts_list');
    }
}
