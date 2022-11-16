<?php

namespace App\Helpers;

class ResponseFormatter
{
    protected static $response = [
        'message' => null,
        'errors' => null,
        'data' => null,
    ];

    public static function success($message = null, $data = null, $code = 200,  $errors = null)
    {
        self::$response['message'] = $message;
        self::$response['errors'] = $errors;
        self::$response['data'] = $data;

        return response()->json(self::$response, $code);
    }

    public static function error($message = null, $errors = null, $code = 404)
    {
        self::$response['message'] = $message;
        self::$response['errors'] = $errors;
        self::$response['data'] = null;

        return response()->json(self::$response, $code);
    }
}
