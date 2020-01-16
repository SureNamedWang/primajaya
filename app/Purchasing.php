<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchasing extends Model
{
    //
    protected $table = 'purchasing';
    public $timestamps = false;
    public function purchashingOrders()
    {
        return $this->hasOne('App\Orders', 'id', 'id_orders');
    }
}
