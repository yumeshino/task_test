<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    public function area(){
        return $this->belongsTo('App\Model\Area');
    }
}
