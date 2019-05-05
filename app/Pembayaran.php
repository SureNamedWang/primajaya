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
}
