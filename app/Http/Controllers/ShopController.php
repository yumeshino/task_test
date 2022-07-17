<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Shop;
use App\Model\Area;

class ShopController extends Controller
{
    public function index(){
        //主 -> 従
        $area_tokyo = Area::find(1)->shops;
        
        //主 <- 従
        $shop = Shop::find(2)->area->name;
        dd($area_tokyo,$shop);
        
    }
}
