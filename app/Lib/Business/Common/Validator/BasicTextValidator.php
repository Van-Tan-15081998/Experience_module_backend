<?php

namespace App\Lib\Business\Common\Validator;

use App\Lib\Business\Common\Exception\DreamerInvalidParameterException;
use Illuminate\Contracts\Validation\ImplicitRule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class BasicTextValidator implements ImplicitRule
{
    protected bool $required;
    protected ?int $minLength;
    protected ?int $maxLength;
    protected bool $result = true;
    protected array $message = array();

    public function __construct(bool $required,
                                int $minLength = null,
                                int $maxLength = null)
    {
        $this->required = $required;

        if((! is_null($minLength)) && ( $minLength <= 0)) {
            $minLength = null;
        }
        if((! is_null($maxLength)) && ( $maxLength <= 0)) {
            $maxLength = null;
        }
        if ((! is_null($minLength)) && (is_null($maxLength))) {
            throw new DreamerInvalidParameterException();
        }
        if (((! is_null($minLength)) && (! is_null($maxLength))) &&
            ($minLength > $maxLength)) {
            throw new DreamerInvalidParameterException();
        }

        $this->minLength = $minLength;
        $this->maxLength = $maxLength;
    }

    public function passes($attribute, $value)
    {
        $this->message = [];
        $this->result = true;
        $this->required($attribute, $value);

        return $this->result;
    }

    public function required($attribute, $value) {
        if(is_null($value)) {
            $this->message[] = 'Đây là trường bắt buộc';
            $this->result = false; // => false sẽ ném lỗi

            throw new HttpResponseException(response()->json(['errors' => $this->message()], 422));
        }
    }

    public function message()
    {
        return $this->message;
    }
}
