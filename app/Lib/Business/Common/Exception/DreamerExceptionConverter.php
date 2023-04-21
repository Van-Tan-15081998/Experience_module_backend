<?php

namespace App\Lib\Business\Common\Exception;

use App\Lib\Common\Core\DataSource\Exception\DataSourceException;
use Exception;

class DreamerExceptionConverter
{
    public static function convertException(Exception $e): void
    {

        if ($e instanceof DataSourceException) {

            // TODO

        } else {

            throw $e;

        }
    }
}
