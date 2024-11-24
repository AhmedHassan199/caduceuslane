<?php
namespace App\Helpers;

class ApiResponseHelper
{
    /**
     * Success Response
     */
    public static function success($data, $message = 'Success', $status = 200)
    {
        return response()->json([
            'status' => true,
            'code' => $status,
            'message' => $message,
            'data' => $data,
        ], $status);
    }

    /**
     * Error Response
     */
    public static function error($message = 'Error', $status = 400)
    {
        return response()->json([
            'status' => false,
            'code' => $status,
            'message' => $message,
        ], $status);
    }
}
