<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;

class debugController extends Controller
{
    public function index()
    {
        $start = date("YmdHis") . '.' . substr(explode(".", microtime(true))[1], 0, 4);
        Log::info("start time:" . $start);

        // $input = Carbon ::now();
        // $result = $input->timestamp;
        // $user = User::select(
        //     'id',
        //     'name',
        // )->get();

        $now =new \DateTime('now');
        $now2 = $now->modify('+1 day');
        $result = $now2->format('Y-m-d');

        // foreach(range(1,1000000)as $val){
        //     $result+=$val+1;
        // }

        // foreach(range(1,1000000)as $val){
        //     $result+=User::sum($val);
        // }


        $end = date("YmdHis") . '.' . substr(explode(".", microtime(true))[1], 0, 4);
        Log::info("end time:" . $end);

        return view('debug.index', [
            'start' => $start,
            'end' => $end,
            'result' => $result,
        ]);
    }
}
