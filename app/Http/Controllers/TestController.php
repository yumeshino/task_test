<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\Test;

//ファザードを使いたい時には最後の部分をかえてつかう
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{

    //
    public function index()
    {
        $values = Test::all();
        
        $tests = DB::table('tests')
        ->select('id')
        ->get();

        dd($tests);

        $collection = collect([1, 2, 3, 4, 5, 6, 7]);

        $chunks = $collection->chunk(4);

        $chunks->all();

        dd($chunks);

        return view('tests.test',compact('values'));
    }
}
