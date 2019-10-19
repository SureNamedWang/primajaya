<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departemen extends Model
{
    //
    public function departemenDivisi()
    {
        return $this->hasOne('App\Divisi', 'id', 'id_divisis');
    }
}
