<?php

namespace App\Http\Controllers\Common\Authentication;

use Illuminate\Foundation\Http\FormRequest;

class LoginFormRequest extends FormRequest
{
    public function getCredentials() {
        return request(['loginId', 'password']);
    }

    public function rules() {
        return [
            'loginId'   => ['required'],
            'password' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'loginId.required'  => ':attribute là thuộc tính bắt buộc',
            'password.required' => ':attribute là thuộc tính bắt buộc',
        ];
    }
}
