<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bahan extends Model
{
    //
    protected $table = 'bahans';
    public $timestamps = false;
    public function MasterBahan(){
    	return $this->hasOne('App\MasterBahan', 'id', 'id_master_bahan');
    }
}
