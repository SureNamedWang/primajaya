<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Harga extends Model
{
    //
	protected $table = 'produk';
	public $timestamps = false;
	public function hargaUkuran()
	{
		return $this->belongsTo('App\Ukuran', 'id_ukuran', 'id');
	}

	public function hargaTipe()
	{
		return $this->belongsTo('App\tipeUkuran', 'id_tipe', 'id');
	}

	public function hargaBahan()
	{
		return $this->hasMany('App\Bahan', 'id_produk', 'id');
	}
}
