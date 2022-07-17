<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    public function shops(){
        return $this->hasMany('App\Model\Shop');
    }
}
