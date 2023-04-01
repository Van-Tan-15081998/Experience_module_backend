<?php

namespace App\Lib\WebCommon\Helpers;

use App\Lib\WebCommon\Constants\MessageType;

class ResponseSuccessfulStatus
{
    private MessageType $type;
    private ?string $code;
    private string $message;

    public function __construct()
    {

    }

    public static function createInstance(MessageType $type, string $message, string $code=null): ResponseSuccessfulStatus
    {
        $instance = new ResponseSuccessfulStatus();

        $instance->type = $type;
        $instance->message = $message;
        $instance->code = $code;

        return $instance;
    }

    public function toArray(): array
    {
        $target = get_object_vars($this);
        $target['type'] = $this->type->getType();

        return json_decode(json_encode($target), true);
    }
}
