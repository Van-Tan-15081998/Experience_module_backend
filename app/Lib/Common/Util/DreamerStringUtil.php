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

    public static function toSlug($str) : string
    {
        $str = trim(mb_strtolower($str));
        $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
        $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
        $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
        $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
        $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
        $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
        $str = preg_replace('/(đ)/', 'd', $str);
        $str = preg_replace('/[^a-z0-9-\s]/', '', $str);
        $str = preg_replace('/([\s]+)/', '-', $str);

        return $str;
    }
}
