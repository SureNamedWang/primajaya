<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ukuran extends Model
{
    //
    protected $table = 'ukuran';
    public $timestamps = false;
    public function hargaUkuran(){
    	return $this->hasMany('App\Harga', 'id_ukuran', 'id');
    }
    public function MasterUkuran(){
    	return $this->belongsTo('App\MasterUkuran', 'id_mukuran', 'id');
    }
}
