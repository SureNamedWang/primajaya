<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    //
    protected $table = 'orders';

    public function ordersKeranjang()
    {
        return $this->hasMany('App\Keranjang', 'id_orders', 'id');
    }
    public function OrdersUsers()
    {
        return $this->hasOne('App\User', 'id', 'id_user');
    }
    public function ordersPengiriman()
    {
        return $this->hasOne('App\pengiriman', 'orders_id', 'id');
    }
    public function ordersPurchasing()
    {
        return $this->hasMany('App\Purchashing', 'id_orders', 'id');
    }
}
