<?php

namespace App\Lib\Common\Util;

class DreamerStringUtil
{
    /**
     * Trả về true nếu đối số là null hoặc một chuỗi rỗng.
     *
     * Các mẫu trả về true là:
     *  . Nếu đối số là null
     *  . Khi loại đối số là chuỗi (String) và chuỗi rỗng
     * */
    public static function isNullOrEmpty(mixed $value) :bool
    {
        if ((is_null($value)) || ($value === '')) {
            return true;
        }
        return false;
    }

    public static function padLeft(string $value, int $len, string $paddingString) :string
    {
        return str_pad($value, $len, $paddingString, STR_PAD_LEFT);
    }

    public static function padLeftFromInt(int $value, int $len, string $paddingString) :string
    {
        return self::padLeft((string)$value, $len, $paddingString);
    }

    public static function padRight(string $value, int $len, string $paddingString) :string
    {
        return str_pad($value, $len, $paddingString, STR_PAD_RIGHT);
    }

    public static function padRightFromInt(int $value, int $len, string $paddingString) :string
    {
        return self::padRight((string)$value, $len, $paddingString);
    }
}
