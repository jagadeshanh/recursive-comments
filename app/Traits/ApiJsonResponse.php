<?php

namespace App\Traits;

trait ApiJsonResponse
{
    private $res = [
        'error' => null,
        'data'  => null,
        'msg'   => null
    ];

    public function errorResponse($data,$msg){
        $this->res['error'] = true;
        $this->res['data'] = $data;
        $this->res['msg'] = $msg;
        return $this->res;
    }

    public function successResponse($data,$msg){
        $this->res['error'] = false;
        $this->res['data'] = $data;
        $this->res['msg'] = $msg;
        return $this->res;
    }
}