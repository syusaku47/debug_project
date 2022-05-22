<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class debugController extends Controller
{
    public function test()
    {
        dd('test');
    }
}
