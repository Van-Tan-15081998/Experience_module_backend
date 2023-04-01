<?php

namespace App\Lib\Business\Authentication\StaffAccount\Models;

class AuthLoggedInModel
{
    private string $token;

    public function getToken(): string
    {
        return $this->token;
    }

    public function setToken(string $token): void
    {
        $this->token = $token;
    }

    public function toArray(): array
    {
        $target = get_object_vars($this);
        return json_decode(json_encode($target), true);
    }
}
