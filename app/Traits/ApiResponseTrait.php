<?php

namespace App\Traits;
trait ApiResponseTrait
{
    protected function successResponse($data, $message = null, $status = 200)
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data
        ], $status);
    }
     protected function successResponseWithToken($data, $message = null, $status = 200,$token=null)
    {
        return response()->json([
            'token' => $token,
            'status' => 'success',
            'message' => $message,
            'data' => $data
        ], $status);
    }

    protected function errorResponse($message, $status=400)
    {
        return response()->json([
            'status' => 'error',
            'message' => $message
        ], $status);
    }
}