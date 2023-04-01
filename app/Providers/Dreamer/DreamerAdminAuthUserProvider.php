<?php

namespace App\Providers\Dreamer;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;

class DreamerAdminAuthUserProvider implements UserProvider
{

    public function retrieveById($identifier)
    {
        // TODO: Implement retrieveById() method.
        return null;
    }

    public function retrieveByToken($identifier, $token)
    {
        // TODO: Implement retrieveByToken() method.
        return null;
    }

    public function updateRememberToken(Authenticatable $user, $token)
    {
        // TODO: Implement updateRememberToken() method.
    }

    public function retrieveByCredentials(array $credentials)
    {
        // TODO: Implement retrieveByCredentials() method.
        return null;
    }

    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        // TODO: Implement validateCredentials() method.
        return true;
    }
}
