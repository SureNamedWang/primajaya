<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class penyimpanan_bahan extends Model
{
    //
    protected $table = 'penyimpanan_bahan';
    public function penyimpananMasterBahan(){
    	return $this->hasOne('App\MasterBahan', 'id', 'master_bahans_id');
    }
}
