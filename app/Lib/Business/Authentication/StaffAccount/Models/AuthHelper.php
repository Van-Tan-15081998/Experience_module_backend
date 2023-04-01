<?php

namespace App\Lib\Business\Authentication\StaffAccount\Models;

class AuthHelper
{
    public static function generateUser(StaffAuthenticationModel $account): AuthUser
    {
        $user = new AuthUser();

        $user->setAccountId($account->getStaffAccountId());
        $user->setLoginId($account->getLoginId());
        $user->setLastName($account->getLastName());
        $user->setFirstName($account->getFirstName());

        return $user;
    }
}
