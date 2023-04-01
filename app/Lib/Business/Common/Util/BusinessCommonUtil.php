<?php

namespace App\Lib\Business\Common\Util;

class BusinessCommonUtil
{
    public static function toName(string $lastName, string $firstName): string
    {
        return $lastName . ' ' . $firstName;
    }
}
