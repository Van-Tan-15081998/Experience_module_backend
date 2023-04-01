<?php

namespace App\Lib\WebCommon\Constants;

use MyCLabs\Enum\Enum;

class MessageType extends Enum
{
    public const INFO = ['info'];
    public const WARNING = ['warning'];
    public const ERROR = ['error'];
    public const ALERT = ['alert'];

    public function getType(): string
    {
        return $this->value[0];
    }

    public function toString(): string
    {
        return $this->getType();
    }
};


