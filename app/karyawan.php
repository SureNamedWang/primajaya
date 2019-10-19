<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class karyawan extends Model
{
    //
    public function karyawanDivisi()
	{
		return $this->hasOne('App\Divisi', 'id', 'divisis_id');
	}
}
