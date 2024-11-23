<?php

namespace App\Helpers;

class ApiResponseHelper
{
    /**
     * Success response
     *
     * @param mixed $data
     * @param string $message
     * @param int $status
     * @return \Illuminate\Http\JsonResponse
     */
    public static function success($data, $message = 'Success', $status = 200)
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'code' => $status,
            'data' => $data,
        ], $status);
    }

    /**
     * Error response
     *
     * @param string $message
     * @param int $status
     * @return \Illuminate\Http\JsonResponse
     */
    public static function error($message = 'Error', $status = 400)
    {
        return response()->json([
            'status' => false,
            'message' => $message,
            'code' => $status,
        ], $status);
    }
}
