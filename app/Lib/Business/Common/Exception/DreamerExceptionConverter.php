<?php

namespace App\Lib\Business\Common\Exception;

use App\Lib\Common\Core\DataSource\Exception\DataSourceException;
use Exception;

class DreamerExceptionConverter
{
    public static function convertException(Exception $e, array $debugInfo = []): void
    {

        if ($e instanceof DataSourceException) {

            // TODO
            self::convertDataSourceException($e, $debugInfo);

        } else {

            throw $e;

        }
    }

    private static function convertDataSourceException(DataSourceException $e, array $debugInfo = []): void
    {
        throw new DreamerSystemException( '123', 'Lỗi liên quan đến DataSource', null, $debugInfo);
    }
}
