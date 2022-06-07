<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class debugController extends Controller
{
    public function index()
    {
        $start = date("YmdHis") . '.' . substr(explode(".", microtime(true))[1], 0, 4);
        \Log::info("start time:" . $start);

        // 処理を記載
        foreach (range(1, 1000000) as $value) {
            if($value === 1000000){
                break;
            }
        }
        foreach (range(1, 1000000) as $value) {
            if($value === 1000000){
                break;
            }
        }


        $end = date("YmdHis") . '.' . substr(explode(".", microtime(true))[1], 0, 4);
        \Log::info("end time:" . $end);

        return view('debug.index', [
            'start' => $start,
            'end' => $end
        ]);

    }
}
