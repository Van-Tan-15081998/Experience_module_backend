<?php

namespace App\Lib\Common\Util;

class DreamerNumberUtil
{
    private const PERIOD = '.';

    private const COMMA = ',';

    private const BLANK = '';

    /**
     * Kiểm tra xem một giá trị có phải là một giá trị nguyên không
     *
     * Giá trị hợp lệ:
     *  . Giá trị số nguyên (giá trị dương hoặc âm)
     *  . Phạm vi:
     *      - PHP_INT_MIN (-9223372036854775808) ~ PHP_INT_MAX (9223372036854775807)
    **/
    public static function isInt(mixed $var): bool
    {
        if(is_null($var)) {
            return false;
        }

        if(!preg_match('/^[+-]?([0-9]\d*)$/', $var . '')){
            return false;
        }

        return true;
    }

    /**
     * Kiểm tra xem một giá trị có phải là một giá trị thập phân không
     *
     * Giá trị hợp lệ:
     *  . Số thập phân (giá trị dương và âm)
     **/
    public static function isDecimal(mixed $var): bool
    {
        if(is_null($var)) {
            return false;
        }

        $pattern = '/^(-?[0-9]+)(\.?)([0-9]*)$/';
        if(!preg_match($pattern, $var, $match)) {
            // Nếu pattern không phù hợp
            return false;
        }

        return true;
    }
}
