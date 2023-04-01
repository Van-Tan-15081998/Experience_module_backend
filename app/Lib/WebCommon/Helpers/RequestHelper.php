<?php

namespace App\Lib\WebCommon\Helpers;

class RequestHelper
{
    public static function nullToEmptyString(?string $value): string
    {
        return is_null($value) ? '' : $value;
    }
}
