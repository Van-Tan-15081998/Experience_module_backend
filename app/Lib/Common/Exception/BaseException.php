<?php

declare(strict_types=1);

namespace App\Lib\Common\Exception;

use Illuminate\Support\Facades\Log;
use Exception;
use Throwable;

class BaseException extends Exception
{
    public function __construct (mixed $message = null, int $code = 0, Throwable|null $previous = null, string $className = null)
    {
        if(isset($className)) {
            if(isset($message)) {
                if(is_string($message)) {
                    $message = '[' . $className .'] ' . $message;
                }
            } else {
                $message = '[' . $className .']';
            }
        }

        if(isset($message)){
            Log::error($message);
        }
        if(isset($previous)) {
            Log::error($previous->getMessage());
        }

        parent::__construct((string)$message, $code, $previous);
    }
}
