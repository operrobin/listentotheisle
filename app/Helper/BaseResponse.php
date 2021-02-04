<?php
namespace App\Helper;


class BaseResponse {

    public static function response($data = [], $message = "", $code = 200) {
        return response([
            "status" => $code == 200,
            "message" => $message,
            "data" => $data,
            "code" => $code
        ], $code);
    }

    public static function ok($data = [], $message = "") {
        return self::response($data, $message);
    }

    public static function error($message = "", $code = 500) {
        return self::response(null, $message, $code);
    }

}
