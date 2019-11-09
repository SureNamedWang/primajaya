<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    //
    protected $table = 'pembayaran';

    public function pembayaranOrders()
    {
        return $this->hasOne('App\Orders', 'id', 'id_orders');
    }
    public function pembayaranLog()
    {
        return $this->hasMany('App\log_pembayaran', 'id_pembayaran', 'id');
    }
}
