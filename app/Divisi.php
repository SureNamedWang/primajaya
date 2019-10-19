<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Divisi extends Model
{
    //
    public function divisiDepartemen()
	{
		return $this->belongsTo('App\Departemen', 'departemens_id', 'id');
	}
}
