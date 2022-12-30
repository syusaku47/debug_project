<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $_status_msg = 'Success';

    public function jsonResponse($res, $status_code = 200, $res_key = "data"): \Illuminate\Http\JsonResponse
    {
        if (
            $status_code == 400 ||
            $status_code == 401 ||
            $status_code == 403 ||
            $status_code == 404 ||
            $status_code == 422 ||
            $status_code == 500
        ) {
            $res = mb_convert_encoding($res, 'UTF-8', 'UTF-8');
            $mes = [];
            if (is_array($res)) {
                foreach ($res as $mes_arr)
                    foreach ($mes_arr as $v)
                        $mes[] = $v;
            } else {
                $mes = [$res];
            }


            switch ($status_code) {
                case 400:
                    $this->_status_msg = 'Bad Request';
                    break;
                case 401:
                    $this->_status_msg = 'Unauthorized';
                    break;
                case 403:
                    $this->_status_msg = 'Forbidden';
                    break;
                case 404:
                    $this->_status_msg = 'Not Found';
                    break;
                case 422:
                    $this->_status_msg = 'Validated';
                    break;
                case 500:
                    $this->_status_msg = 'Internal Server Error';
                    break;
            }

            $result = [
                'status' => $this->_status_msg,
                'errorCode' => $status_code,
                'message' => $mes,
            ];
        } else {
            $result = ($res === true) ? new \stdClass() : [$res_key => $res];
        }

        return response()->json(
            $result,
            $status_code,
            ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE
        );
    }
}
