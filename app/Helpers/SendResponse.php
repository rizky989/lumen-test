<?php

namespace App\Helpers;

class SendResponse
{
    public static function success($data, $code){
        $response['status'] = 'success';
        $response['data'] = $data;
        
        return response()->json($response, $code);
    }

    public static function fail($data, $code){
        $response['status'] = 'fail';
        $response['data'] = $data;
        
        return response()->json($response,$code);
    }

    public static function error($message, $code){
        $response['status'] = 'error';
        $response['message'] = $message;
        
        return response()->json($response,$code);
    }
}