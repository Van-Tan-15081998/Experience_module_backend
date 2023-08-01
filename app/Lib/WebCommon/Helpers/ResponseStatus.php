<?php

namespace App\Lib\WebCommon\Helpers;

use App\Lib\WebCommon\Constants\MessageType;

class ResponseStatus {

    private MessageType $type;
    private ?string $code = null;
    private ?string $description = null;
    private ?string $message = null;
    private ?array $optional = null;
    private ?array $debugInfo = null;

    public static function createSuccessfulStatus(MessageType $type, string $message): ResponseStatus
    {
        $instance = new ResponseStatus();

        $instance->type = $type;
        $instance->message = $message;

        return $instance;
    }

    public static function createWarningStatus(string $message): ResponseStatus
    {
        $instance = new ResponseStatus();

        $instance->type = MessageType::WARNING();
        $instance->message = $message;

        return $instance;
    }

    public static function createErrorStatus(   ?string  $code,
                                                ?string  $description = null,
                                                ?string  $message = null,
                                                         $optional = null,
                                                array    $debugInfo = []
    ): ResponseStatus
    {
        $instance = new ResponseStatus();

        $instance->type = MessageType::ERROR();
        $instance->code = $code;
        $instance->description = $description;
        $instance->message = $message;
        $instance->optional = $optional;
        $instance->debugInfo = $debugInfo;

        return $instance;
    }

    public static function createErrorMessage(string  $message): ResponseStatus
    {
        $instance = new ResponseStatus();

        $instance->type = MessageType::ERROR();
        $instance->message = $message;

        return $instance;
    }

    public function getType(): MessageType
    {
        return $this->type;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function getOptional(): ?array
    {
        return $this->optional;
    }

    public function getDebugInfo(): ?array
    {
        return $this->debugInfo;
    }

    public function toArray(): array
    {
        $target = get_object_vars($this);
        return json_decode(json_encode($target), true);
    }
}
