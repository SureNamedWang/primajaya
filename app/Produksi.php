<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produksi extends Model
{
    //
    protected $table = 'produksi';

    public function produksiKeranjang()
    {
        return $this->hasOne('App\Keranjang', 'id', 'id_keranjang');
    }
    public function produksiKaryawan()
    {
        return $this->hasOne('App\karyawan', 'id', 'id_karyawan');
    }
}
