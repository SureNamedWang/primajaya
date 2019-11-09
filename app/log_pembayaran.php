<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class log_pembayaran extends Model
{
    //
    public function logPembayaran()
    {
        return $this->hasOne('App\Pembayaran', 'id', 'id_pembayaran');
    }
}
