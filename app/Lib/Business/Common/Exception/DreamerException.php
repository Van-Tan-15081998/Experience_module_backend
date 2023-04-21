<?php

namespace App\Lib\Business\Common\Exception;

use App\Lib\Common\Exception\BaseException;

class DreamerException extends BaseException
{
    protected string $exceptionCode;

    protected string $exceptionMessage;

    public function __construct(string $exceptionCode = '', string $message = '', Throwable $previous = null)
    {
        $this->exceptionCode = $exceptionCode;
        $this->exceptionMessage = $message;

        $messageException =
            "\n" . 'code :' . $this->getExceptionCode() . ', message :' . $this->getExceptionMessage() . "\n";
        parent::__construct($messageException, 0, $previous);
    }

    public function getExceptionCode(): string
    {
        return $this->exceptionCode;
    }

    public function getExceptionMessage(): string
    {
        return $this->exceptionMessage;
    }
}
