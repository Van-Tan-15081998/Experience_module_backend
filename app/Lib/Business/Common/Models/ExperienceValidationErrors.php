<?php

namespace App\Lib\Business\Common\Models;

class ExperienceValidationErrors
{
    private array $errors = [];

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
}
