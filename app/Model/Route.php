<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
     public function shops(){
        return $this->belongsToMany('App\Model\Shop');
    }
}
