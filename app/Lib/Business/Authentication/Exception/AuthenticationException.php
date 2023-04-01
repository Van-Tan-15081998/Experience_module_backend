<?php

namespace App\Lib\Business\Authentication\Exception;

use Exception;
use Throwable;

class AuthenticationException extends Exception
{
    public function __construct(Throwable $previous = null)
    {
        parent::__construct("", 0, $previous);
    }
}
