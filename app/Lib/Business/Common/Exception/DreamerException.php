<?php

namespace App\Lib\Business\Common\Exception;

use App\Lib\Common\Exception\BaseException;
use Throwable;

class DreamerException extends BaseException
{
    protected string $exceptionCode;

    protected string $exceptionMessage;

    protected array $debugInfo;

    public function __construct(string $exceptionCode = '', string $message = '', Throwable $previous = null, array $debugInfo = [])
    {
        $this->exceptionCode = $exceptionCode;
        $this->exceptionMessage = $message;

        $messageException =
            "\n" . 'code :' . $this->getExceptionCode() . ', message :' . $this->getExceptionMessage() . "\n";

        $this->debugInfo = $debugInfo;

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

    public function getExceptionDebugInfo(): array
    {
        return $this->debugInfo;
    }
}
