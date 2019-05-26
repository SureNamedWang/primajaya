<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produksi extends Model
{
    //
    protected $table = 'produksi';

    public function produksiOrders()
    {
        return $this->hasOne('App\Orders', 'id', 'id_orders');
    }
}
