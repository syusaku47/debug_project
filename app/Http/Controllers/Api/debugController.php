<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class debugController extends Controller
{
    public function index()
    {
        try {
            $start = date("YmdHis") . '.' . substr(explode(".", microtime(true))[1], 0, 4);
            Log::info("start time:" . $start);

            // $input = Carbon ::now();
            // $result = $input->timestamp;

            $result =[
                'a'=>1,
                'b'=>2,
            ];
            $input2 =[
                'b'=>3,
                'd'=>4,
            ];

            $result+=$input2;

            $end = date("YmdHis") . '.' . substr(explode(".", microtime(true))[1], 0, 4);
            Log::info("end time:" . $end);

            $data = [
                'time' => $end - $start,
                'result' => $result,
            ];
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getFile());
            Log::error($e->getLine());
            return $this->jsonResponse('システムエラーが発生しました。管理者にご連絡ください。', 500);
        }
        return $this->jsonResponse($data);
    }
}
