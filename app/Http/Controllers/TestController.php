<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\Test;

class TestController extends Controller
{
    //
    public function index()
    {
        $values = Test::all();

        //die + var_dump
        //dd($values);

        return view('tests.test',compact('values'));
    }
}
