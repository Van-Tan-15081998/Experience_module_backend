<?php

namespace App\Lib\Business\Common\Models;

use App\Lib\Common\Type\DreamerTypeObject;

class DreamerValidationErrors extends DreamerTypeObject
{
    private array $errors = [];

    private array $optional = [];

    public function getOptional(): array
    {
        return $this->optional;
    }

    public function setOptional(array $optional): void
    {
        $this->optional = $optional;
    }

    public function addError(string $key, string $message): void
    {
        $this->errors[$key] = $message;
    }

    public function addErrorAsArray(string $key, string $message): void
    {
        $this->errors[$key][] = $message;
    }

    public function empty(): bool
    {
        return empty($this->errors);
    }

    public function toArray(): array
    {
        return parent::toArrayFromModel($this->errors);
    }
}
