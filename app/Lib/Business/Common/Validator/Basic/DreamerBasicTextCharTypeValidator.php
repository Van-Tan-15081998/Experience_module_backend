<?php

namespace App\Lib\Business\Common\Validator\Basic;

use Illuminate\Contracts\Validation\ImplicitRule;

class DreamerBasicTextCharTypeValidator implements ImplicitRule
{
    protected array $message;

    public function passes($attribute, $value)
    {

    }

    public function message(): array|string
    {
        return $this->message;
    }
}
